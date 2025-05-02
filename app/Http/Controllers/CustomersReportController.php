<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;

class CustomersReportController extends Controller
{
    public function index(){

        $sections = Section::all();
        return view('reports.customers_report',compact('sections'));
          
}
}