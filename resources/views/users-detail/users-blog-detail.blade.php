@extends('layouts.app')

@section('content')
    <div class="w-full my-4 rounded">
        <h1>{{ $blog->title }}</h1>
    </div>
    <div class="w-full my-4 rounded">
        <p>{!! nl2br(e($blog->content)) !!}</p>
    </div>

    @if (Auth::check())
        @include('goods.good_button', ['blog' => $blog])
    @endif

    <div class="w-full my-4 rounded">
        <h2>コメント</h2>
        @if ($comments->isEmpty())
            <p>コメントはありません。</p>
        @else
            @foreach ($comments as $comment)
                <div>
                    {{-- ユーザー名 --}}
                    <span>{{ $comment->user->name }}</span>
                    <span class="text-muted text-gray-500">posted at {{ $comment->created_at }}</span>
                </div>
                <div>
                    {{-- 投稿内容 --}}
                    <p class="mb-0">{!! nl2br(e($comment->content)) !!}</p>
                </div>

                @if (Auth::id() == $comment->user_id)
                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm normal-case" onclick="return confirm('Delete id = {{ $comment->id }} ?')">Delete</button>
                </form>

            @endif
            @endforeach
        @endif

        @if (Auth::check())
            @include('comments.form', ['blog' => $blog])
        @endif
    </div>
@endsection