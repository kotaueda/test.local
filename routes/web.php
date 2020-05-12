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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

// フォルダ作成ページを表示する
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create'); // 名前付きルートを使うことでURLを一括変更できる
// フォルダ作成処理を実行する
Route::post('/folders/create', 'FolderController@create'); // 同じURLでHTTPメソッド違いのルートがいくつかある場合、どれか一つに名前をつければいい

// タスク作成ページを表示する 
Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create'); 
// タスク作成処理を実行する 
Route::post('/folders/{id}/tasks/create', 'TaskController@create');

// タスク編集ページを表示する 
Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
// タスク編集処理を実行する 
Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');

// トップページを表示する
Route::get('/', 'HomeController@index')->name('home');