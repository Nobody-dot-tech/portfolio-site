@extends('admin-layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">楽曲新規登録</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form method="POST" action="{{ route('admin-works.store') }}">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="composer" class="block text-gray-700 text-sm font-bold mb-2">作曲者</label>
                <input type="text" name="composer" id="composer" value="{{ old('composer') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('composer')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="arranger" class="block text-gray-700 text-sm font-bold mb-2">編曲者</label>
                <input type="text" name="arranger" id="arranger" value="{{ old('arranger') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('arranger')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-gray-700 text-sm font-bold mb-2">演奏時間</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('duration')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">演奏した日</label>
                <input type="text" name="date" id="date" value="{{ old('date') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="place" class="block text-gray-700 text-sm font-bold mb-2">演奏した場所</label>
                <input type="text" name="place" id="place" value="{{ old('place') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('place')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="artist" class="block text-gray-700 text-sm font-bold mb-2">演奏者</label>
                <input type="text" name="artist" id="artist" value="{{ old('artist') }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('artist')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">作品の説明、コメントなど</label>
                <textarea name="comment" id="comment" rows="5"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">タグ</label>
                <div class="flex flex-wrap -mx-2">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center mx-2 my-1">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                  @if(in_array($tag->id, (array)old('tags', [])))
                                      checked
                                  @endif
                                  class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2 text-gray-700">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('tags')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    追加
                </button>
                <a href="{{ route('admin-works.index') }}" class="text-gray-600 hover:text-gray-800">キャンセル</a>
            </div>
        </form>
    </div>
@endsection