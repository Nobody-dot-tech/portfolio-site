<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\Tag;
use App\Models\User;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

        return view('users.works', compact('works', 'allTags'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return view('users-detail.users-work-detail', compact('work'));
    }
}
