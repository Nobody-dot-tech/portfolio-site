@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">過去に演奏した楽曲</h1>

    {{-- 検索フォーム --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">楽曲を検索する</h2>
        <form  method="GET" action="{{ route('works.index') }}">
            <div class="mb-4">
                <label for="keyword" class="block text-gray-700 text-sm font-bold mb-2">フリーワード検索</label>
                <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      placeholder="タイトル、作曲者などで検索">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">タグで絞り込む</label>
                <div class="flex flex-wrap -mx-2">
                    @foreach($allTags as $tag)
                        <label class="inline-flex items-center mx-2 my-1">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                  @if ( in_array($tag->id, (array)request('tags', [])) )
                                      checked
                                  @endif
                                  class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2 text-gray-700">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    検索
                </button>
                @if(request()->hasAny(['keyword', 'tags']))
                    <a href="{{ route('works.index') }}" class="text-gray-600 hover:text-gray-800">検索をクリア</a>
                @endif
            </div>
        </form>
    </div>

    {{-- ジャンル検索 (ピックアップタグ) --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">ジャンルから探す</h2>
        <div class="flex flex-wrap gap-4">
            {{-- ピックアップするタグのIDをここに直接記述するか、コントローラから渡す --}}
            @php
                $pickupTagIds = [1, 4, 5]; // 例: 'Rock', 'Pop', 'Jazz' のIDを想定
                $pickupTags = $allTags->whereIn('id', $pickupTagIds);
            @endphp
            @foreach($pickupTags as $tag)
                <form action="{{ route('works.index') }}" method="GET" class="inline-block">
                    <input type="hidden" name="tags[]" value="{{ $tag->id }}">
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                        {{ $tag->name }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>

    {{-- 楽曲検索結果一覧 --}}
    @if(request()->hasAny(['keyword', 'tags']))
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">検索結果</h2>
            @if($works->isEmpty())
                <p class="text-gray-600">条件に一致する楽曲は見つかりませんでした。</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($works as $work)
                        <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <h3 class="text-xl font-bold mb-2">{{ $work->title }}</h3>
                            <p class="text-gray-600 mb-2">作曲者：{{ $work->composer ?? '不明' }}</p><br>
                            <p class="text-gray-600 mb-2">編曲者：{{ $work->arranger ?? '不明' }}</p><br>
                            <div class="mb-4">
                                @foreach($work->tags as $tag)
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <p class="text-gray-700 mb-4 line-clamp-3">{!! nl2br(e(Str::limit($work->comment, 150))) !!}</p>
                            <div class="text-right">
                                <a href="{{ route('works.show', $work) }}"
                                  class="text-blue-500 hover:text-blue-700 font-semibold">詳細を見る</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $works->links() }} {{-- ページネーションリンク --}}
                </div>
            @endif
        </div>
    @endif
@endsection