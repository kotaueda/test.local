<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- IEのバージョンごとに表示崩れがしないよう、各バージョンのモードでレンダリングする -->
  <title>ToDo App</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">ToDo App</a>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダを追加する</div>
            <div class="panel-body">
            　<!-- formアクションでurlを呼び出し、フォームを使ってデータを送る -->
              <form action="{{ route('folders.create') }}" method="post"> 
              　<!-- 他サイトからの悪意あるPOSTリクエストを受け付けないよう、自分のサイトからのPOSTリクエストだけ受け付けるため、CSRFトークンを用いる -->
                @csrf 
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  <input type="text" class="form-control" name="title" id="title" />
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </main>
</body>
</html>