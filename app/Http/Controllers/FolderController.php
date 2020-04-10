<?php

namespace App\Http\Controllers;

use App\Folder; 
// クラスのインポート
use Illuminate\Http\Request;

class FolderController extends Controller
{
    // フォルダのフォームを表示画面をビューテンプレートへ返す
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // 引数にインポートしたRequestクラスを受け入れる
    public function create(Request $request)
    {
        // フォルダモデルのインスタンスを作成
        $folder = new Folder();
        // タイトルに入力値を代入する
        // リクエストクラスのインスタンスにリクエストヘッダや送信元IP、フォームの入力値などが入っている
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
