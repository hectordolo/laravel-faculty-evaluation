<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
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

    public function index()
    {
        $user = Auth::user();

        return view('pages.profile.index', compact('user'));
    }

    public function image(){

        $user = Auth::user();

        if(File::exists(storage_path('app/img/'.$user->employee_id.'.jpg'))){
            return response()->download(storage_path('app/img/'.$user->employee_id.'.jpg'));
        }else{
            return response()->download(storage_path('app/img/empty.jpg'));
        }
    }

    public function name(){

        $user = Auth::user();

        return response()->json($user);

    }

    public function upload(){

        $user = Auth::user();

        if(Input::file('file')){
            $file = Input::file('file');

            Storage::disk('local')->put('/img/'.$user->employee_id.'.jpg', File::get($file));

            flash('Profile Pic Changed', 'success');
            return redirect()->route('profile.index');
        }else{

            flash('Please Choose a Picture', 'warning');
            return redirect()->route('profile.index');

        }
    }

    public function remove(){

        $user = Auth::user();

        Storage::disk('local')->delete('/img/'.$user->employee_id.'.jpg');

        flash('Profile Picture Deleted', 'success');
        return redirect()->route('profile.index');
    }
}
