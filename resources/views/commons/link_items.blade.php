{{-- ニュース一覧へのリンク --}}
{{-- <li><a class="link link-hover" href="{{ route('users.news') }}">News</a></li> --}}
{{-- 公演情報一覧へのリンク --}}
<li><a class="link link-hover" href="{{ route('concerts.index') }}">concerts information</a></li>
{{-- ブログ記事一覧へのリンク --}}
<li><a class="link link-hover" href="{{ route('blogs.index') }}">blogs</a></li>
{{-- ファンクラブトップページへのリンク --}}
{{-- <li><a class="link link-hover" href="{{ route('users.fanclub') }}">fanclub</a></li> --}}
{{-- プロフィールページへのリンク --}}
{{-- <li><a class="link link-hover" href="{{ route('users.profile') }}">Taki&#39;s profile</a></li> --}}
{{-- 演奏した楽曲一覧へのリンク --}}
<li><a class="link link-hover" href="{{ route('works.index') }}">performed works</a></li>
{{-- お問い合わせページへのリンク --}}
{{-- <li><a class="link link-hover" href="{{ route('users.contact') }}">cntact</a></li> --}}

@if (\Auth::check())
    {{-- いいね一覧へのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.goods') }}">いいね一覧</a></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- 会員登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Sign Up</a></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Sign In</a></li>
@endif