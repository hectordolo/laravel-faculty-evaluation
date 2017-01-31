<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class DeanEvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('faculty')){

            $deans = [];

            return view('pages.dean.index', compact('deans'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function evaluate($sjc_id)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('faculty')){

            $dean = User::where('sjc_id', $sjc_id)
                ->first();

            return view('pages.dean.evaluate', compact('dean'));

        }else{

            return redirect()->route('four.zero.five');
        }

    }
}
