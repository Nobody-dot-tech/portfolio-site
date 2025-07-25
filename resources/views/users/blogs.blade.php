@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ブログ記事一覧</h1>

        @if ($blogs->isEmpty())
        <p>まだブログ記事がありません。</p>
        @else
            @foreach($blogs as $blog)
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">{{ $blog->title }}</h2>
                        <p class="card-text">{!! nl2br(e(Str::limit($blog->content, 150))) !!}</p>
                        <a class="btn btn-primary" href="{{ route('blogs.show', $blog->id) }}">続きを読む</a>
                        <p class="text-muted text-right"><small>投稿日：{{ $blog->created_at->format('Y/m/d H:i') }}</small></p>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
@endsection