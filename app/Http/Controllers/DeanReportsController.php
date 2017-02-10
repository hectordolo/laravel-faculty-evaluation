<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentHeads;
use App\Models\GlobalVariables;

use Auth;

class DeanReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            return view('pages.reports.dean.index');
        }else{
            return redirect()->route('four.zero.five');
        }

    }
}
