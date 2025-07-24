<h2>ブログ記事</h2>
@if ($blogs->isEmpty())
    <p>まだブログ記事がありません。</p>
@else
    @foreach($blogs as $blog)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $blog->title }}</h2>
                <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                <p class="text-muted text-right"><small>投稿日：{{ $blog->created_at->format('Y/m/d H:i') }}</small></p>
            </div>
        </div>
    @endforeach
    <a class="btn btn-primary" href="{{ route('blogs.index') }}">ブログ一覧を見る</a>
@endif