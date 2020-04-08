<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="../../css/styles.css">
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
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="#" class="btn btn-default btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a 
                href="{{ route('tasks.index', ['id' => $folder->id]) }}" 
                class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
                {{ $folder->title }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <!-- ここにタスクが表示される -->
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="#" class="btn btn-default btn-block">
                タスクを追加する
              </a>
            </div>
          </div>
          <!-- 選択されたフォルダのタスクの状況をタイトル・状態・期限ごとに表示する -->
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              <!-- foreach文は配列に含まれた要素の分だけ繰り返し処理を行う -->
              @foreach($tasks as $task)
                <tr>
                  <!-- コントローラーからシーダーに登録されたデータを取得し、ブラウザに表示する -->
                  <td>{{ $task->title }}</td>
                  <td>
                    <!-- アクセサメソッドを参照するときは文字の区切りがアンダースコアになる -->
                    <!-- ラベル部分のクラス属性を追加 -->
                    <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span> <!-- タスクの進捗状況 -->
                  </td>
                  <td>{{ $task->due_date }}</td>
                  <td><a href="#">編集</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
</body>
</html>