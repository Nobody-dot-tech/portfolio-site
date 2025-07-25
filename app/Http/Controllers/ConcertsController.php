<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\User;

class ConcertsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerts = Concert::orderBy('created_at', 'desc')->paginate(5);

        return view('users.concerts', compact('concerts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Concert $concert)
    {
        return view('users-detail.users-concert-detail', compact('concert'));
    }
}
