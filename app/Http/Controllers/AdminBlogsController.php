<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Admin;

class AdminBlogsController extends Controller
{
    public function index()
    {
        $data = [];
        $admin = \Auth::guard('admin')->user();

        if($admin) {
            $blogs = $admin->all_blogs()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'blogs' => $blogs,
            ];
        } else {
            return redirect('/admin/login')->withErrors(['error' => '管理者としてログインしてください。']);
        }

        return view('admin.admin-blogs', $data);
    }

    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $blog = new Blog;

        return view('admin-create.admin-blog-create', [
            'blog' => $blog,
        ]);
    }

    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->blogs()->create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            return redirect()->route('admin-blogs.index');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    // getでmessages/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit(Blog $blog)
    {
        return view('admin-edit.admin-blog-edit', compact('blog'));
    }

    // putまたはpatchでmessages/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->blogs()->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            return redirect()->route('admin-blogs.index')->with('success', 'ブログ記事が更新されました。');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    // deleteでmessages/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        if (\Auth::id() === $blog->admin_id) {
            $blog->delete();
            return back()->with('success', 'Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }
}
