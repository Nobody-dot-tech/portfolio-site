@if (Auth::guard('admin')->check())
    <div class="mt-4">
        <form method="POST" action="{{ route('admin-blogs.update', $blog->id) }}">
            @csrf
            @method('PUT')
            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">タイトル</span>
                </label>
                <input type="text" name="title" class="input input-bordered w-full" value="{{ old('title', $blog->title) }}" placeholder="ブログのタイトルを入力してください" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">本文</span>
                </label>
                <textarea rows="10" name="content" class="input input-bordered w-full" placeholder="ブログの本文を入力してください">{{ old('content', $blog->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">Update</button>
        </form>
    </div>
@endif