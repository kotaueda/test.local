<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ページの認証をルートごとの処理に移る前にプログラムを実行するため、ミドルウェアを用いる
// 認証状態の確認を様々なルートに共通して行うため、ミドルウェアが適している
Route::group(['middleware' => 'auth'], function() {

  // トップページを表示する
  Route::get('/', 'HomeController@index')->name('home');

  // フォルダ作成ページを表示する
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create'); // 名前付きルートを使うことでURLを一括変更できる
  // フォルダ作成処理を実行する
  Route::post('/folders/create', 'FolderController@create'); // 同じURLでHTTPメソッド違いのルートがいくつかある場合、どれか一つに名前をつければいい

  Route::group(['middleware' => 'can:view,folder'], function() {

    // タスク一覧のエラーの挙動をまとめて管理するルート定義を編集する
    Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

    // タスク作成ページを表示する 
    Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    // タスク作成処理を実行する 
    Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

    // タスク編集ページを表示する 
    Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    // タスク編集処理を実行する 
    Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    
  }); 

  // 登録完了ページを表示する
  Route::get('/completion', 'CompletionController@index')->name('completion');

});

// 会員登録・ログイン・ログアウト・パスワード再設定の各機能で必要なルーティング設定をすべて定義する
Auth::routes();