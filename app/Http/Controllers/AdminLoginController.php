<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;

class AdminLoginController extends Controller
{
    // @param \Illuminate\Http\Request $request
    // @return \Illuminate\Http\Response

    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (\Auth::guard('admin')->attempt($credentials)) { //ログイン試行
            if ($request->user('admin')?->admin_level > 0) { //管理者レベルがゼロでないか
                $request->session()->regenerate(); //セッション更新

                // return redirect()->intended('admin/dashboard');
                return redirect()->intended(RouteServiceProvider::ADMIN_HOME);

            } else {
                \Auth::guard('admin')->logout(); //if文でログインしてしまっているので、ログアウトさせる

                $request->session()->regenerate(); //セッション更新

                return back()->withErrors([ //権限レベルが0の場合
                    'error' => 'You do not have permission to log in.',
                ]);
            }
        }

        return back()->withErrors([ //ログインに失敗した場合
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function adminLogout(Request $request)
    {
        \Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
