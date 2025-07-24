@if (Auth::user()->is_gooding($blog->id))
    {{-- いいね解除ボタンのフォーム --}}
    <form method="POST" action="{{ route('goods.cancel_good', $blog->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-block normal-case"
            onclick="return confirm('id = {{ $blog->id }} のいいねを外します。よろしいですか？')">Cancel Good</button>
    </form>
@else
    {{-- いいねボタンのフォーム --}}
    <form method="POST" action="{{ route('goods.become_good', $blog->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block normal-case">Good</button>
    </form>
@endif