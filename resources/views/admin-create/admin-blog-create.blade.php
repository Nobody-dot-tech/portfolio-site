@if (Auth::guard('admin')->check())
    <div class="mt-4">
        <form method="POST" action="{{ route('admin-blogs.store') }}">
            @csrf
            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">タイトル</span>
                </label>
                <input type="text" name="title" class="input input-bordered w-full" placeholder="ブログのタイトルを入力してください" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">本文</span>
                </label>
                <textarea rows="10" name="content" class="input input-bordered w-full" placeholder="ブログの本文を入力してください"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">Create</button>
        </form>
    </div>
@endif