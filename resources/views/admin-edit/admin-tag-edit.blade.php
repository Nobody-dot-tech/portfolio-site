@extends('admin-layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">タグ編集: {{ $tag->name }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin-tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">タグ名 <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $tag->name) }}" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      placeholder="例: Rock, Pop, Jazz">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    更新
                </button>
                <a href="{{ route('admin-tags.index') }}" class="text-gray-600 hover:text-gray-800">キャンセル</a>
            </div>
        </form>
    </div>
@endsection