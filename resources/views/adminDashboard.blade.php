@extends('admin-layouts.app')

@section('content')

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
@endsection