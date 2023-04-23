@if (Auth::check())
    {{-- タスク作成ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('tasks.create') }}">新規タスクの投稿</a></li>
        <li class="divider lg:hidden"></li>

    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    <li class="divider lg:hidden"></li>

    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif