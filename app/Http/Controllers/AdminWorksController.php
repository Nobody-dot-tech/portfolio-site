<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\Tag;
use App\Models\Admin;

class AdminWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admin = \Auth::guard('admin')->user();

        if($admin) {
            $query = Work::with('tags');

            if ($request->filled('keyword')) {
                $keyword = $request->input('keyword');
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('composer', 'like', "%{$keyword}%")
                    ->orWhere('arranger', 'like', "%{$keyword}%")
                    ->orWhere('date', 'like', "%{$keyword}%")
                    ->orWhere('place', 'like', "%{$keyword}%")
                    ->orWhere('artist', 'like', "%{$keyword}%")
                    ->orWhere('comment', 'like', "%{$keyword}%");
                });
            }

            if ($request->has('tags') && is_array($request->input('tags'))) {
                $tagIds = $request->input('tags');

                $query->where(function ($q) use ($tagIds) {
                    foreach ($tagIds as $index => $tagId) {
                        if ($index === 0) {
                            $q->whereHas('tags', function ($subQuery) use ($tagId) {
                                $subQuery->where('tags.id', $tagId);
                            });
                        } else {
                            $q->orwhereHas('tags', function ($subQuery) use ($tagId) {
                                $subQuery->where('tags.id', $tagId);
                            });
                        }
                    }
                });
            }

            $works = $query->paginate(10);
            $allTags = Tag::all();

            return view('admin.admin-works', compact('works', 'allTags'));

        } else {
            return redirect('/admin/login')->withErrors(['error' => '管理者としてログインしてください。']);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $work = new Work;
        $tags = Tag::all();

        return view('admin-create.admin-work-create', [
            'work' => $work,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'composer' => 'required|max:255',
            'arranger' => 'nullable|max:255',
            'duration' => 'required|max:255',
            'date' => 'required|max:255',
            'place' => 'required|max:255',
            'artist' => 'required|max:255',
            'comment' => 'required|max:65535',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $work = $admin->works()->create([
                'title' => $request->input('title'),
                'composer' => $request->input('composer'),
                'arranger' => $request->input('arranger'),
                'duration' => $request->input('duration'),
                'date' => $request->input('date'),
                'place' => $request->input('place'),
                'artist' => $request->input('artist'),
                'comment' => $request->input('comment'),
            ]);

            // $work = Work::create($request->only(['title', 'composer', 'arranger', 'duration', 'date', 'place', 'artist', 'comment']));

            if ($request->has('tags')) {
                $work->tags()->attach($request->input('tags'));
            }

            return redirect()->route('admin-works.index');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        $tags = Tag::all();
        $selectedTags = $work->tags->pluck('id')->toArray();
        return view('admin-edit.admin-work-edit', compact('work', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work $work)
    {
        $request->validate([
            'title' => 'required|max:255',
            'composer' => 'required|max:255',
            'arranger' => 'nullable|max:255',
            'duration' => 'required|max:255',
            'date' => 'required|max:255',
            'place' => 'required|max:255',
            'artist' => 'required|max:255',
            'comment' => 'required|max:65535',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->blogs()->update([
                'title' => $request->input('title'),
                'composer' => $request->input('composer'),
                'arranger' => $request->input('arranger'),
                'duration' => $request->input('duration'),
                'date' => $request->input('date'),
                'place' => $request->input('place'),
                'artist' => $request->input('artist'),
                'comment' => $request->input('comment'),
            ]);

            $work->tags()->sync($request->input('tags', []));

            return redirect()->route('admin-works.index')->with('success', '楽曲が更新されました。');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $work = Work::findOrFail($id);

        $work->delete();
        return back()->with('success', 'Delete Successful');
    }
}
