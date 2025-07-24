@extends('admin-layouts.app')

@section('content')
    <div class="container">
        <h1>ブログ記事一覧</h1>

        @if ($blogs->isEmpty())
            <p>まだブログ記事がありません。</p>

        @else
            @foreach($blogs as $blog)
            <div class="w-full my-4 rounded">
                <h2>{{ $blog->title }}</h2>
            </div>

            @if (Auth::guard('admin')->id() == $blog->admin_id)
                <a href="{{ route('admin-blogs.edit', $blog->id) }}" class="btn btn-sm normal-case bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    <button type="submit" class="btn btn-sm normal-case">Edit</button>
                </a>
                <form method="POST" action="{{ route('admin-blogs.destroy', $blog->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm normal-case" onclick="return confirm('Delete id = {{ $blog->id }} ?')">Delete</button>
                </form>
            @endif
            @endforeach

            <div class="mt-6">
                {{ $blogs->links() }}
            </div>
        @endif
        <div class="w-full my-4 rounded">
            <form method="GET" action="{{ route('admin-blogs.create') }}">
                @csrf
                <button type="submit" class="btn btn-sm normal-case">create new blog</button>
            </form>
        </div>
    </div>
@endsection