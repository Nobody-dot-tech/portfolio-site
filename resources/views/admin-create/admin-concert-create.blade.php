@if (Auth::guard('admin')->check())
    <div class="mt-4">
        <form method="POST" action="{{ route('admin-concerts.store') }}">
            @csrf
            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">タイトル</span>
                </label>
                <input type="text" name="title" class="input input-bordered w-full" placeholder="ブログのタイトルを入力してください" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">日程</span>
                </label>
                <input type="date" name="date" class="input input-bordered w-full" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">場所</span>
                </label>
                <input type="text" name="place" class="input input-bordered w-full" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">開場</span>
                </label>
                <input type="text" name="open" class="input input-bordered w-full" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">開演</span>
                </label>
                <input type="text" name="start" class="input input-bordered w-full" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">プログラム</span>
                </label>
                <textarea rows="10" name="program" class="input input-bordered w-full" ></textarea>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">見どころ</span>
                </label>
                <textarea rows="10" name="comment" class="input input-bordered w-full" ></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">Create</button>
        </form>
    </div>
@endif