@if (Auth::guard('admin')->check())
    <div class="mt-4">
        <form method="POST" action="{{ route('admin-concerts.update', $concert->id) }}">
            @csrf
            @method('PUT')
            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">公演名</span>
                </label>
                <input type="text" name="title" class="input input-bordered w-full"  value="{{ old('title', $concert->title) }}" placeholder="ブログのタイトルを入力してください" />
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">日程</span>
                </label>
                <input type="date" name="date" class="input input-bordered w-full"  value="{{ old('date', $concert->date) }}"/>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">場所</span>
                </label>
                <input type="text" name="place" class="input input-bordered w-full"  value="{{ old('place', $concert->place) }}"/>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">開場</span>
                </label>
                <input type="text" name="open" class="input input-bordered w-full"  value="{{ old('open', $concert->open) }}"/>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">開演</span>
                </label>
                <input type="text" name="start" class="input input-bordered w-full"  value="{{ old('start', $concert->start) }}"/>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">プログラム</span>
                </label>
                <textarea rows="10" name="program" class="input input-bordered w-full">{{ old('program', $concert->program) }}</textarea>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">見どころ</span>
                </label>
                <textarea rows="10" name="comment" class="input input-bordered w-full">{{ old('comment', $concert->comment) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">Update</button>
        </form>
    </div>
@endif