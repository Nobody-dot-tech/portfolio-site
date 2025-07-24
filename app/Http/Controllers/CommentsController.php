<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(5);

        return view('users-detail.users-blog-detail', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $user = \Auth::user();

        if ($user) {
            $user->comments()->create([
                'content' => $request->input('content'),
                'blog_id' => $request->input('blog_id'),
            ]);

            return redirect()->route('blogs.show', ['blog' => $request->input('blog_id')])
                            ->with('success', 'コメントを投稿しました。');

        } else {
            return redirect()->back()->with('error', 'ログインしていません。');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        if (\Auth::id() === $comment->user_id) {
            $comment->delete();
            return back()->with('success', 'Delete Successful');
        }

        return back()->with('Delete Failed');
    }
}
