<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
        <title>ダッシュボード</title>
    </head>
    <body class="antialiased">
        <ul>
            <li>
                ログイン中：{{ \Auth::guard('admin')->user()->name ?? 'undefined' }}
            </li>
            <li>
                <a href="{{ route('admin.logout') }}">
                    ログアウト
                </a>
            </li>
            <li>
                <a href="{{ route('admin.register') }}">
                    アカウント作成
                </a>
            </li>
        </ul>
    </body>
</html>