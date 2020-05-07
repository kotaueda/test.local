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
  </nav>
</header>
<main>
　<!-- section ～ endsectionに置き換わってHTMLが作成される -->
  @yield('content')
</main>
<!-- section ～ endsectionに置き換わってHTMLが作成される -->
@yield('scripts')
</body>
</html>