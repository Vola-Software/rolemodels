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

    public function welcome()
    {
        return view('welcome');
    }

    public function downloadSafeguardPolicy()
    {
        $file = public_path()."/resources/Safeguarding children policy final Sep 2018.pdf";
        $headers = array('Content-Type: application/pdf',);

        return \Response::download($file, 'Safeguarding children policy final Sep 2018.pdf', $headers);
    }
}
