<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">  <!-- IEのバージョンごとに表示崩れがしないよう、各バージョンのモードでレンダリングする -->
  <title>ToDo App</title>
  <!-- section ～ endsectionに置き換わってHTMLが作成される -->
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
<nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
      <!-- ログインしていればtrueを返し、ログインしてなければfalseを返す -->
      <!-- Auth::guestの場合はユーザーがログインしていない場合にtrueを返す -->
      @if(Auth::check())
        <!-- Auth::userでログイン中のユーザーを取得する -->
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      @else
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
      @endif
    </div>
  </nav>
</header>
<main>
　<!-- section ～ endsectionに置き換わってHTMLが作成される -->
  @yield('content')
</main>
<!-- section ～ endsectionに置き換わってHTMLが作成される -->

  <!-- ログアウトリンクのクリックイベントで、リンクの下に置いたフォームを送信する -->
  @if(Auth::check())
    <script>
      document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
      });
    </script>
  @endif

@yield('scripts')
</body>
</html>