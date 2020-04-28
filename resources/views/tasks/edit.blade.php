@extends('layout')

<!-- flatpickr/sytylesファイルのyieldに対応している -->
@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを編集する</div>
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
            <form
                action="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                method="POST"
            >
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <!-- 入力エラーでフォーム画面に戻ったとき、old関数からセッション値を取得し、入力欄の値を復元させる -->
                <!-- 第二引数を指定し、直前の入力値がない場合、$task->titleを出力する -->
                <input type="text" class="form-control" name="title" id="title"
                       value="{{ old('title') ?? $task->title }}" />
              </div>
              <div class="form-group">
                <label for="status">状態</label>
                <!-- 状態の入力欄をセレクトボックスで作る -->
                <!-- optionタグで囲んだ文字列をブラウザに表示し、selectタグのnameタグの値をキー、optionタグの値を値と値としたデータセットをサーバーに送る -->
                <!-- Taskモデルで定義した配列定数STATUSをforeachでループしてoption要素を出力 -->
                <select name="status" id="status" class="form-control">
                  <!-- foreach文でキー変数を用いて、配列の要素が代入された値変数をキー変数にも代入する -->
                  <!-- option要素のvalueに配列のキー（1,2,3）を代入し、表示文字列に'label'の値を出力する -->
                  @foreach(\App\Task::STATUS as $key => $val)
                    <!-- セレクトボックスは、selected属性の置かれた option要素が初期表示で選択状態となる -->
                    <!-- keyとold'status', $task->status（直前の入力値またはデータベースに登録済みの値）を比べて、一致する場合にoptionタグの中に'selected'を出力する -->
                    <option
                        value="{{ $key }}"
                        {{ $key == old('status', $task->status) ? 'selected' : '' }}
                    >
                      {{ $val['label'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date"
                       value="{{ old('due_date') ?? $task->formatted_due_date }}" />
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

<!-- flatpickr/scriptsファイルのyieldに対応している -->
@section('scripts')
  @include('share.flatpickr.scripts')
@endsection