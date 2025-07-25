<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Concert;

class DashboardController extends Controller
{
    public function dashboard_contents()
    {
        $concerts = Concert::orderBy('created_at', 'desc')->take(3)->get();

        $blogs = Blog::orderBy('created_at', 'desc')->take(3)->get();

        return view('dashboard', compact('concerts', 'blogs'));
    }

}
