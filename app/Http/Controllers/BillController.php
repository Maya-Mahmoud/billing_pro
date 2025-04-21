<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\bills_attachments;
use App\Models\bills_details;
use App\Models\prodacts;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\Add_bill_new;
use App\Notifications\AddBill;
use App\Events\MyEventClass;

class BillController extends Controller
{

    public function index()
    {
        $bills = bill::all();
        return view('bills.bills', compact('bills'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('bills.added', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Bill::create([
            'bill_number' => $request->bill_number,
            'bill_Date' => $request->bill_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'Unpaid',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $bill_id = bill::latest()->first()->id;
        bills_details::create([
            'id_bill' => $bill_id,
            'bill_number' => $request->bill_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'Unpaid',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        if ($request->hasFile('pic')) {

            $bill_id = bill::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $bill_number = $request->bill_number;

            $attachments = new bills_attachments();
            $attachments->file_name = $file_name;
            $attachments->bill_number = $bill_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->bill_id = $bill_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $bill_number), $imageName);
        }


         $user = User::first();
        Notification::send($user, new AddBill($bill_id));



        event(new MyEventClass('hello world'));

        session()->flash('Add', 'The bill has been added successfully');
        return back();




    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bills = Bill::with('section')->find($id);
        
        return view('bills.status_update', compact('bills'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bills = Bill::with('section')->find($id);
        $Section = Section::all();
        return view('bills.edit_bill', compact('Section', 'bills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $bills = bill::findOrFail($request->bill_id);
        $bills->update([
            'bill_number' => $request->bill_number,
            'bill_Date' => $request->bill_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'the bill edit successfuly');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->bill_id;
        $bills = bill::where('id', $id)->first();
        $Details = bills_attachments::where('bill_id', $id)->first();

         $id_page =$request->id_page;


        if (!$id_page==2) {

        if (!empty($Details->bill_number)) {

            Storage::disk('public_uploads')->deleteDirectory($Details->bill_number);
        }

        $bills->forceDelete();
        session()->flash('delete_bill');
        return redirect('/bills');

        }

        else {

            $bills->delete();
            session()->flash('archive_bill');
            return redirect('/Archive');
        }
    }

    public function getprodacts($id)
    {
        $products = prodacts::where('section_id', $id)->pluck('product_name', 'id'); 

        return response()->json($products);
    }

    public function Status_Update($id, Request $request)
    {
        $bills = bill::find($id);
        
        if (!$bills) {
            return redirect('/bills')->with('error', 'الفاتورة غير موجودة!');
        }
    
        if (!$bills->bill_number) {
            return redirect()->back()->with('error', 'رقم الفاتورة غير متوفر!');
        }
    
       
        $status = strtolower($request->Status);
        
      
        $statusValue = 2; 
        if ($status === 'paid') {
            $statusValue = 1; 
        } elseif ($status === 'partially paid') {
            $statusValue = 3; // مدفوعة جزئيًا
        }
    
        //  تحديث بيانات الفاتورة
        $bills->update([
            'Value_Status' => $statusValue,
            'Status' => $request->Status,
            'Payment_Date' => $request->Payment_Date,
        ]);
    
        //  إضافة سجل في bills_details
        bills_Details::create([
            'id_bill' => $bills->id, 
            'bill_number' => $bills->bill_number, 
            'product' => $bills->product, //  تجنب الخطأ
            'Section' => $bills->section_id, //  تأكد أن القسم ممرّر بشكل صحيح
            'Status' => $request->Status,
            'Value_Status' => $statusValue,
            'Payment_Date' => $request->Payment_Date,
            'user' => Auth::user()->name,
        ]);
    
        session()->flash('success', 'bill status updated successfully');
        return redirect('/bills');
    }
    
    
    public function bill_Paid()
    { 
      
        $bills = Bill::where('Value_Status', 1)->get();
        return view('bills.bills_paid', compact('bills'));
    }

    public function bill_unPaid()
{
    $bills = Bill::where('Value_Status', 2)->get();
    return view('bills.bills_unpaid', compact('bills'));
}

public function bill_Partial()
{
    $bills = Bill::where('Value_Status', 3)->get();
    return view('bills.bills_Partilly', compact('bills'));
}
public function Print_bill($id){


    $bills = bill::where('id', $id)->first();
    return view('bills.Print_bill',compact('bills'));
}
    

}
