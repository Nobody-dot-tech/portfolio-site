<h2>公演情報</h2>
@if ($concerts->isEmpty())
    <p>まだ公演情報がありません。</p>
@else
    @foreach($concerts as $concert)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $concert->title }}</h2>
                <p class="card-text">{{ Str::limit($concert->comment, 150) }}</p>
                <p class="text-muted text-right"><small>投稿日：{{ $concert->created_at->format('Y/m/d H:i') }}</small></p>
            </div>
        </div>
    @endforeach
    <a class="btn btn-primary" href="{{ route('concerts.index') }}">公演情報一覧を見る</a>
@endif