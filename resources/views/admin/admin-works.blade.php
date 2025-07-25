@extends('admin-layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">過去に演奏した作品リスト 管理ページ</h1>

    {{-- 新規楽曲追加ボタン --}}
    <div class="mb-6 text-right">
        <a href="{{ route('admin-works.create') }}"
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            作品を追加
        </a>
    </div>

    {{-- 検索フォーム --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">作品を検索する</h2>
        <form action="{{ route('admin-works.index') }}" method="GET">
            <div class="mb-4">
                <label for="keyword" class="block text-gray-700 text-sm font-bold mb-2">フリーワード検索</label>
                <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      placeholder="タイトル、作曲者、説明などで検索">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">タグで絞り込む</label>
                <div class="flex flex-wrap -mx-2">
                    @foreach($allTags as $tag)
                        <label class="inline-flex items-center mx-2 my-1">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                  @if(in_array($tag->id, (array)request('tags', [])))
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
                    <a href="{{ route('admin-works.index') }}" class="text-gray-600 hover:text-gray-800">検索をクリア</a>
                @endif
            </div>
        </form>
    </div>

    {{-- 楽曲一覧 --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">登録済み作品一覧</h2>
        @if($works->isEmpty())
            <p class="text-gray-600">作品はまだ登録されていません。</p>
        @else
            @if(request()->hasAny(['keyword', 'tags']))
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b text-left">ID</th>
                                <th class="py-2 px-4 border-b text-left">タイトル</th>
                                <th class="py-2 px-4 border-b text-left">作曲者</th>
                                <th class="py-2 px-4 border-b text-left">編曲者</th>
                                <th class="py-2 px-4 border-b text-left">タグ</th>
                                <th class="py-2 px-4 border-b text-left">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($works as $work)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b">{{ $work->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $work->title }}</td>
                                    <td class="py-2 px-4 border-b">{{ $work->composer }}</td>
                                    <td class="py-2 px-4 border-b">{{ $work->arranger ?? '不明' }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @foreach($work->tags as $tag)
                                            <span class="inline-block bg-gray-200 rounded-full px-2 py-0.5 text-xs font-semibold text-gray-700 mr-1 mb-1">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="py-2 px-4 border-b whitespace-nowrap">
                                        <a href="{{ route('admin-works.edit', $work) }}"
                                          class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">編集</a>
                                        <form action="{{ route('admin-works.destroy', $work) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('本当に削除しますか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8">
                    {{ $works->links() }} {{-- ページネーションリンク --}}
                </div>
            @endif
        @endif
    </div>
@endsection