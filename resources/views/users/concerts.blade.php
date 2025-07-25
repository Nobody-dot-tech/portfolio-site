@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>公演情報一覧</h1>

        @if ($concerts->isEmpty())
        <p>まだ公演情報がありません。</p>
        @else
            @foreach($concerts as $concert)
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">{{ $concert->title }}</h2>
                        <p class="card-text">{{ $concert->date }}</p>
                        <p class="card-text">{{ $concert->place }}</p>
                        <p class="card-text">{!! nl2br(e(Str::limit($concert->comment, 150))) !!}</p>
                        <a class="btn btn-primary" href="{{ route('concerts.show', $concert->id) }}">続きを読む</a>
                        <p class="text-muted text-right"><small>投稿日：{{ $concert->created_at->format('Y/m/d H:i') }}</small></p>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $concerts->links() }}
            </div>
        @endif
    </div>
@endsection