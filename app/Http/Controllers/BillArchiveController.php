<?php

namespace App\Http\Controllers;
use App\Models\bill;
use Illuminate\Http\Request;

class BillArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = bill::onlyTrashed()->get();
        return view('bills.archive_bills',compact('bills'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->bill_id;
        $flight = Bill::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_bill');
        return redirect('/bills');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bills = bill::withTrashed()->where('id',$request->bill_id)->first();
        $bills->forceDelete();
        session()->flash('delete_bill');
        return redirect('/Archive');
   
    }
}
