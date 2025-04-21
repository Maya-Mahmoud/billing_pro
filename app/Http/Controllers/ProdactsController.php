<?php

namespace App\Http\Controllers;

use App\Models\prodacts;
use App\Models\Section;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ProdactsController extends Controller
{ use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections=Section::all();
        $prodacts=prodacts::all();
       return view('prodacts.prodact',compact('sections','prodacts'));
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
        $validatedData = $request->validate([
            'Product_name' => 'required|string|max:255',
            'section_id' => 'required|integer',
        ]);
       prodacts::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'Products added successfully');
        return redirect('/prodacts');
    }

    /**
     * Display the specified resource.
     */
    public function show(prodacts $prodacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prodacts $prodacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = Section::where('section_name', $request->section_name)->first()->id;

        $Products = Prodacts::findOrFail($request->id);

        $Products->update([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);

        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $Products = Prodacts::findOrFail($request->id);
        $Products->delete();
        session()->flash('delete', 'The prodact has been deleted successfully');
        return back();
    }

}
