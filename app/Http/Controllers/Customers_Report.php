<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Section;
use App\Models\Bill;
class Customers_Report extends Controller
{
    public function index(){

      $sections = Section::all();
      return view('reports.customers_report',compact('sections'));
        
    }


    public function Search_customers(Request $request){


// في حالة البحث بدون التاريخ
      
     if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {

       
      $bills = Bill::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
      $sections = Bill::all();
      return view('reports.customers_report', compact('sections', 'bills'));


    
     }


  // في حالة البحث بتاريخ
     
     else {
       
       $start_at = date($request->start_at);
       $end_at = date($request->end_at);

      $bills = Bill::whereBetween('bill_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
       $sections = Bill::all();
       return view('reports.customers_report', compact('sections', 'bills'));


      
     }
     
  
    
    }
}