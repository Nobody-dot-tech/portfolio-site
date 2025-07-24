<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function goods()
    {
        // idの値でユーザーを検索して取得
        $user = \Auth::user();

        if (!$user) {
            // 例: ログインページにリダイレクトするか、エラーメッセージを表示
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのいいね一覧を取得
        $goods = $user->goods()->orderBy('created_at', 'desc')->paginate(10);

        // いいね一覧ビューでそれらを表示
        return view('users.goods', [
            'user' => $user,
            'goods' => $goods,
        ]);
    }
}
