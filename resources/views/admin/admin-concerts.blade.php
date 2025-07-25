@extends('admin-layouts.app')

@section('content')
    <div class="container">
        <h1>公演情報一覧</h1>

        @if ($concerts->isEmpty())
            <p>まだ公演情報がありません。</p>

        @else
            @foreach($concerts as $concert)
            <div class="w-full my-4 rounded">
                <h2>{{ $concert->title }}</h2>
            </div>

            @if (Auth::guard('admin')->id() == $concert->admin_id)
                <a href="{{ route('admin-concerts.edit', $concert->id) }}" class="btn btn-sm normal-case bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                    <button type="submit" class="btn btn-sm normal-case">Edit</button>
                </a>
                <form method="POST" action="{{ route('admin-concerts.destroy', $concert->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm normal-case" onclick="return confirm('Delete id = {{ $concert->id }} ?')">Delete</button>
                </form>
            @endif
            @endforeach

            <div class="mt-6">
                {{ $concerts->links() }}
            </div>
        @endif
        <div class="w-full my-4 rounded">
            <form method="GET" action="{{ route('admin-concerts.create') }}">
                @csrf
                <button type="submit" class="btn btn-sm normal-case">add new concert information</button>
            </form>
        </div>
    </div>
@endsection