<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Concert;
use App\Models\Admin;

class AdminConcertsController extends Controller
{
    public function index()
    {
        $data = [];
        $admin = \Auth::guard('admin')->user();

        if($admin) {
            $concerts = $admin->all_concerts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'concerts' => $concerts,
            ];
        } else {
            return redirect('/admin/login')->withErrors(['error' => '管理者としてログインしてください。']);
        }

        return view('admin.admin-concerts', $data);
    }

    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $concert = new Concert;

        return view('admin-create.admin-concert-create', [
            'concert' => $concert,
        ]);
    }

    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|date',
            'place' => 'required|max:255',
            'open' => 'required|max:255',
            'start' => 'required|max:255',
            'program' => 'required|max:65535',
            'comment' => 'required|max:65535',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->concerts()->create([
                'title' => $request->input('title'),
                'date' => $request->input('date'),
                'place' => $request->input('place'),
                'open' => $request->input('open'),
                'start' => $request->input('start'),
                'program' => $request->input('program'),
                'comment' => $request->input('comment'),
            ]);

            return redirect()->route('admin-concerts.index');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    // getでmessages/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit(Concert $concert)
    {
        return view('admin-edit.admin-concert-edit', compact('concert'));
    }

    // putまたはpatchでmessages/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, Concert $concert)
    {
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|date',
            'place' => 'required|max:255',
            'open' => 'required|max:255',
            'start' => 'required|max:255',
            'program' => 'required|max:65535',
            'comment' => 'required|max:65535',
        ]);

        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->concerts()->update([
                'title' => $request->input('title'),
                'date' => $request->input('date'),
                'place' => $request->input('place'),
                'open' => $request->input('open'),
                'start' => $request->input('start'),
                'program' => $request->input('program'),
                'comment' => $request->input('comment'),
            ]);

            return redirect()->route('admin-concerts.index')->with('success', 'ブログ記事が更新されました。');

        } else {
            return redirect()->back()->with('error', '管理者としてログインしていません。');
        }
    }

    // deleteでmessages/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy(string $id)
    {
        $concert = Concert::findOrFail($id);

        if (\Auth::id() === $concert->admin_id) {
            $concert->delete();
            return back()->with('success', 'Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }
}
