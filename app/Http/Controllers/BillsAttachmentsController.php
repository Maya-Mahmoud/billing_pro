<?php
namespace App\Http\Controllers;

use App\Models\bills_attachments; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Foundation\Validation\ValidatesRequests;

class BillsAttachmentsController extends Controller
{  
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'file_name' => 'mimes:pdf,jpeg,png,jpg',

        ], [
            'file_name.mimes' => 'the attachment format must be  pdf, jpeg , png , jpg',
        ]);
        
        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments =  new bills_attachments();
        $attachments->file_name = $file_name;
        $attachments->bill_number = $request->bill_number;
        $attachments->bill_id = $request->bill_id;
        $attachments->Created_by = Auth::user()->name;
        $attachments->save();
           
        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'. $request->bill_number), $imageName);
        
        session()->flash('Add', 'Attachments added successfully');
        return back();

    }

    
    /**
     * Display the specified resource.
     */
    public function show(bills_attachments $bills_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bills_attachments $bills_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bills_attachments $bills_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bills_attachments $bills_attachments)
    {
        //
    }
}