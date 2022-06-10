<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.home');
    }

    public function about()
    {
        return view('website.about');
    }

    public function pricing()
    {
        return view('website.pricing');
    }

    public function blog()
    {
        return view('website.blog');
    }

    public function blogDetails($blog)
    {
        return view('website.blog-details');
    }

    public function contact()
    {
        return view('website.contact');
    }
}
