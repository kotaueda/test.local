<?php

namespace App\Http\Controllers;

use App\Folder; 
// クラスのインポート
use Illuminate\Http\Request;
// CreateFolderクラスのインポート
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    // フォルダのフォームを表示画面をビューテンプレートへ返す
    public function showCreateForm()
    {
        return view('folders/create');
    }

    /**
     * 引数をCreateFolderに変更する
     * FormRequestクラスは先ほどまで指定していたRequestクラスと互換性がある
     * 入力値の取得などの機能を維持したまま、バリデーション機能を追加できる
     */
    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成
        $folder = new Folder();
        /** 
         * タイトルに入力値を代入する
         * リクエストクラスのインスタンスにリクエストヘッダや送信元IP、フォームの入力値などが入っている
         */
        $folder->title = $request->title;
        // インスタンスの状態をデータベースへ書き込む
        $folder->save();
        /** 
         * フォルダを作成するルートに画面の出力は必要ないので、フォルダに対応するタスク一覧画面に
         * redirectメソッドを呼び出し偏移させる
         */
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
