<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Author;

class AdminController extends Controller{
    public function getLogIn()
    {
        return view('admin.login');
    }

    public function getLogOut()
    {
        Auth::logout();
        return redirect() -> route('index');
    }

    public function getDashboard(){
        
        $authors = Author::all();
        return view('admin.dashboard', ['authors'=> $authors]);
    }
    public function postLogin(Request $request)
    {
       /* echo 'hi';
        dd($request['name']);*/
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['name' => $request['name'], 'password'=> $request['password']])){
            return redirect()->back()->with(['fail' => 'Could not log you in']);
        }
        return redirect()->route('admin.dashboard');
    }


}