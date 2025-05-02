<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Http\Request;

class Bills_ReportController extends Controller
{
    
    public function index(){

        return view('reports.bills_report');
           
       }
       public function Search_bills(Request $request){

        $rdio = $request->rdio;
    
    
     // في حالة البحث بنوع الفاتورة
        
        if ($rdio == 1) {
           
           
     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                
               $bills = Bill::select('*')->where('Status','=',$request->type)->get();
               $type = $request->type;
               return view('reports.bills_report', compact('type', 'bills'));

            }
            
    // في حالة تحديد تاريخ استحقاق
            else {
               
              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $type = $request->type;
              
              $bills = Bill::whereBetween('bill_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
              return view('reports.bills_report', compact('type', 'start_at', 'end_at', 'bills'));

              
            }
    
     
            
        } 
        
    //====================================================================
        
    // في البحث برقم الفاتورة
        else {
            
            $bills = Bill::select('*')->where('bill_number','=',$request->bill_number)->get();
            return view('reports.bills_report', compact('bills'));

            
        }
    
        
         
        }
}
