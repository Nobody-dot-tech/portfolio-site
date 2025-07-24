<div class="mt-4">
    <form method="POST" action="{{ route('comments.store') }}">
        @csrf

        <input type="hidden" name="blog_id" value="{{ $blog->id }}">

        <label class="label">
            <span class="label-text">コメント入力欄</span>
        </label>
        <div class="form-control mt-4">
            <textarea rows="2" name="content" class="input input-bordered w-full"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block normal-case">Post</button>
    </form>
</div>
