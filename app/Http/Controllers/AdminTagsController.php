<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Admin;

class AdminTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $admin = \Auth::guard('admin')->user();

        if($admin) {
            $tags = Tag::paginate(20);
            $data = [
                'tags' => $tags,
            ];
        } else {
            return redirect('/admin/login')->withErrors(['error' => '管理者としてログインしてください。']);
        }

        return view('admin.admin-tags', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tag = new Tag;

        return view('admin-create.admin-tag-create', [
            'tag' => $tag,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $tag = Tag::create([
                'name' => $request->input('name'),
            ]);

            return redirect()->route('admin-tags.index');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin-edit.admin-tag-edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $tag = Tag::update([
                'name' => $request->input('name'),
            ]);

            return redirect()->route('admin-tags.index')->with('success', '楽曲が更新されました。');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();
        return back()->with('success', 'Delete Successful');
    }
}
