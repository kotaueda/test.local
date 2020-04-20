<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task; //Taskモデルを読み込む
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask; // CreateTaskコントローラーをインポートする

class TaskController extends Controller
{
    public function index(int $id)
    {
        //すべてのフォルダを取得する
        $folders = Folder::all();

        //選択したフォルダを取得する
        $current_folder = Folder::find($id);

        //選択したフォルダに紐づかれたタスクを取得する
        //より直感的な表現に書き換える
        $tasks = $current_folder->tasks()->get(); 

        return view('tasks/index', [
            'folders' => $folders,
            //選択したフォルダのIDを受け取り、view関数でテンプレートに渡す
            'current_folder_id' => $current_folder->id,
            //選択したフォルダに紐づかれたタスクをview関数でテンプレートに渡す
            'tasks' => $tasks,
        ]);
    }

    // 入力フォームを表示するためのルートを実装する 
    public function showCreateForm(int $id) 
    { 
        // URL（/folders/{id}/tasks/create）を作るためのフォルダIDをの引数で受け取る 
        return view('tasks/create', [
             'folder_id' => $id
        ]); 
    }

    // タスクを保存するcreateメソッドを追加する
    public function create(int $id, CreateTask $request)
    {
        // フォルダidを取得し、currrent_folderに代入する
        $current_folder = Folder::find($id);

        // タスクモデルのインスタンスを作成
        $task = new Task();
        // タイトルと期限日の入力値を代入する
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // current_folderに紐づくタスクを保存する
        $current_folder->tasks()->save($task);

        /** 
         * タスクを作成するルートに画面の出力は必要ないので、フォルダに紐づくタスクをタスク一覧画面に
         * redirectメソッドを呼び出し偏移させる
         */
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
}
