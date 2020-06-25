@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <!-- フォルダ作成画面へのリンクを埋める -->
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <!-- idをfolderに変更し、パラメーターに対応させる -->
              <a 
                href="{{ route('tasks.index', ['folder' => $folder->id]) }}" 
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
              <!-- フォルダに紐づいたタスクのデータをコントローラーから受け取り、表示する -->
              <!-- idをfolderに変更し、パラメーターに対応させる -->
              <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
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
                  <!-- 日付変更のメソッドを参照 -->
                  <td>{{ $task->formatted_due_date }}</td>
                  <td>
                    <!-- タスク一覧画面への編集リンク -->
                    <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                        編集
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection