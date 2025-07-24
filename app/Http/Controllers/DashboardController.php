<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function dashboard_blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->take(3)->get();

        return view('dashboard', compact('blogs'));
    }

}
