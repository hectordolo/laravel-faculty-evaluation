<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MigrateRecords;
use App\Models\DepartmentHeads;
use App\Models\GlobalVariables;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();


        return view('home',compact('auth_user'));
    }

    public function fourzerofive()
    {
        return view('errors.405');
    }

    public function sjc_logo()
    {
        return response()->download(storage_path('app/img/sjc_logo.png'));
    }
}
