@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">{{ $work->title }}</h1>
        <p class="text-gray-600 mb-4 text-xl">作曲者：{{ $work->composer ?? '不明' }}</p><br>
        <p class="text-gray-600 mb-4 text-xl">編曲者：{{ $work->arranger ?? '不明' }}</p><br>

        <div class="mb-6">
            @foreach($work->tags as $tag)
                <span class="inline-block bg-blue-100 rounded-full px-4 py-1 text-md font-semibold text-blue-800 mr-2 mb-2">#{{ $tag->name }}</span>
            @endforeach
        </div>

        <div class="mb-6">
            <p class="text-gray-600 mb-4 text-xl">演奏時間：{{ $work->duration ?? '不明' }}</p>
        </div>

        <div class="mb-6">
            <p class="text-gray-600 mb-4 text-xl">演奏した日：{{ $work->date ?? '不明' }}</p>
        </div>

        <div class="mb-6">
            <p class="text-gray-600 mb-4 text-xl">演奏した場所：{{ $work->place ?? '不明' }}</p>
        </div>

        <div class="mb-6">
            <p class="text-gray-600 mb-4 text-xl">演奏者：{{ $work->artist ?? '不明' }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-2">作品の説明、コメントなど</h2>
            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $work->comment }}</p>
        </div>

        <div class="mt-8 text-right">
            <a href="{{ route('works.index') }}"
              class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                一覧に戻る
            </a>
        </div>
    </div>
@endsection