<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function store(string $id)
    {
        \Auth::user()->become_good(intval($id));

        return back();
    }

    public function destroy(string $id)
    {
        \Auth::user()->cancel_good(intval($id));

        return back();
    }
}
