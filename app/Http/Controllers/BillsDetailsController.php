<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\bills_attachments;
use App\Models\bills_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BillsDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = bills_details::all();
        
        return view('bills.details_bill', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(bills_details $bills_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bills = Bill::with('section')->find($id);
       
        $details  = bills_details::where('id_bill',$id)->get();
        $attachments  = bills_attachments::where('bill_id',$id)->get();

        return view('bills.details_bill',compact('bills','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bills_details $bills_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $bills = bills_attachments::findOrFail($request->id_file);
        $bills->delete();
        Storage::disk('public_uploads')->delete($request->bill_number.'/'.$request->file_name);
        session()->flash('delete', 'the attachment deleted suscusfuly');
        return back();
    }

 


    public function get_file($bill_number,$file_name)

    {
        $contents=  'Attachments/' . $bill_number . '/' . $file_name;
        return response()->download( $contents);
    }

    public function open_file($bill_number, $file_name)
    {

        $filePath = 'Attachments/' . $bill_number . '/' . $file_name;

        if (!file_exists(public_path($filePath))) {
            return response()->json(['error' => 'الملف غير موجود'], 404);
        }

        return response()->file(public_path($filePath));
    }



}
