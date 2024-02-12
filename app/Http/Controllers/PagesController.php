<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Controllers\NewsController;

class PagesController extends Controller
{
    public function index()
    {
       return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }

}
