<!-- resources/views/layout.blade.phpをレイアウトファイルとして使用することを宣言 -->
@extends('layout')

<!-- レイアウトファイルのyieldに対応している -->
@section('styles')
  <!-- スタイルシートはhead内で読み込む -->
  <!-- JavaScriptのflatpickrライブラリを読み込む -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- flatpickrライブラリの色をブルーテーマにカスタマイズするためのファイルを読み込む -->
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

<!-- レイアウトファイルのyieldに対応している -->
@section('content') 
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを追加する</div>
          <div class="panel-body">
            <!-- ルール違反の内容が詰められた$errors変数を使ってルール違反があったかを確認する -->
            @if($errors->any())
              <div class="alert alert-danger"> 
                <!-- ルール違反があった場合、エラーメッセージを列挙する -->
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <!-- formアクションでurlを呼び出し、フォームを使ってデータを送る -->
            <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
              <!-- 他サイトからの悪意あるPOSTリクエストを受け付けないよう、自分のサイトからのPOSTリクエストだけ受け付けるため、CSRFトークンを用いる -->
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <!-- 入力エラーでフォーム画面に戻ったとき、old関数からセッション値を取得し、入力欄の値を復元させる -->
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <!-- 新たにタスクの期限を入力するフォームを作成する -->
              <div class="form-group">
                <label for="due_date">期限</label>
                <!-- 入力エラーでフォーム画面に戻ったとき、old関数からセッション値を取得し、入力欄の値を復元させる -->
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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
@endsection

<!-- レイアウトファイルのyieldに対応している -->
@section('scripts')
<!-- スクリプトはbodyの一番最後で読み込む -->
<!-- flatpickrスクリプトを読み込む -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<!-- 日本語化するためのスクリプト追加する -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>

<!-- getElementByIdは任意のHTMLタグで指定した引数にマッチするドキュメント要素を取得するメソッド -->
<!-- minDateオプションで本日の日付より若い日付を入力できないようにする -->
<script>
  flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
</script>
@endsection