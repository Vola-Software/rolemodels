<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;
use Prismic\Dom\RichText;
use App\Services\GeneralLinkResolver;

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

    public function downloadUsefulResource($fileName)
    {
        $file = public_path()."/resources/$fileName";
        $headers = array('Content-Type: application/pdf',);

        return \Response::download($file, $fileName, $headers);
    }
}