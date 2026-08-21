<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function faq()
    {
        return view('pages.faq');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
}