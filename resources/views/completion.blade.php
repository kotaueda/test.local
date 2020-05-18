@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">
            登録完了しました
          </div>
          <div class="panel-body">
            <div class="text-center">
              <!-- ログインページへのリンクを表示する -->
              <a href="{{ route('login') }}" class="btn btn-primary">
                ログインページへ
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection