<?php

namespace App\Http\Controllers;

use App\Models\Section; 
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;


class SectionsController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Section::all(); // استخدام الاسم الصحيح
        return view('sections.section', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // هنا يمكنك إضافة منطق عرض نموذج لإنشاء قسم جديد
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ]);

        Section::create([
            'section_name' => $request->section_name,
            'description'  => $request->description,
            'created_by'   => Auth::user()->name, // تأكد من أن الاسم صحيح
        ]);

        session()->flash('Add', 'the section added secsesfuly');
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sections $sections)
    {
        // عرض تفاصيل القسم المحدد
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sections $sections)
    {
        // هنا يمكنك إضافة منطق عرض نموذج لتحرير القسم
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,

        ],[

            'section_name.required' =>'please enter  section name',
            'section_name.unique' =>'The section name has already been found',
            'description.required' =>'please enter descraption',

        ]);

        $sections = Section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','The section has been updated successfully');
        return redirect('/sections');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $section = Section::find($id);
    
        if ($section) {
            // تحديث جميع الفواتير المرتبطة بجعل section_id = NULL
            \DB::table('bills')->where('section_id', $id)->update(['section_id' => null]);
            
            // حذف القسم بعد تحديث الفواتير
            $section->delete();
        }
    
        session()->flash('delete', 'The section has been deleted successfully');
        return redirect('/sections');
    }
}
