@extends('admin-layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">管理者: タグ管理</h1>

    {{-- 新規タグ追加ボタン --}}
    <div class="mb-6 text-right">
        <a href="{{ route('admin-tags.create') }}"
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            新規タグを追加
        </a>
    </div>

    {{-- タグ一覧 --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">登録済みタグ一覧</h2>
        @if($tags->isEmpty())
            <p class="text-gray-600">タグはまだ登録されていません。</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">ID</th>
                            <th class="py-2 px-4 border-b text-left">タグ名</th>
                            <th class="py-2 px-4 border-b text-left">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $tag->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $tag->name }}</td>
                                <td class="py-2 px-4 border-b whitespace-nowrap">
                                    <a href="{{ route('admin-tags.edit', $tag) }}"
                                      class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">編集</a>
                                    <form action="{{ route('admin-tags.destroy', $tag) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('このタグを削除しますか？関連する作品との紐付けも解除されます。');">
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
                {{ $tags->links() }} {{-- ページネーションリンク --}}
            </div>
        @endif
    </div>
@endsection