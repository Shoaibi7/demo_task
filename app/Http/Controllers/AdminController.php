<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $companies = Company::orderBy('id','DESC')->get();
        return view('admin.dashboard',compact('companies'));
    }
}
