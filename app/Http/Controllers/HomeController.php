<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('upload');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        //Generate a file name with extension
        $filename = 'profile-'. $file->getClientOriginalName();

        //Save the file
        $path = $file->storeAs('uploads', $filename);

        dd($path);


    }
}
