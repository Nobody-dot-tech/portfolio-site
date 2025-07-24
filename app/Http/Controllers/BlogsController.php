<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = [];
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);
        // $data = [
        //     'title' => $blogs->title,
        //     'content' => $blogs->content,
        // ];
        return view('users.blogs', compact('blogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        // $blog = Blog::findOrFail($id);
        $comments = $blog->comments()->orderBy('created_at', 'desc')->paginate(5);

        return view('users-detail.users-blog-detail', compact('blog', 'comments'));
    }
}
