<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task; //Taskモデルを読み込む
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask; // CreateTaskコントローラーをインポートする
use App\Http\Requests\EditTask; // EditTaskコントローラーをインポートする
use Illuminate\Support\Facades\Auth; // Authクラスをインポートする

class TaskController extends Controller
{
    /**
     * idからfolderを受け取るよう記述しなおすことで、URL中のIDに該当するフォルダデータが
     * コントローラーメソッド渡される 
     * @param Folder $folder
     * @return \Illuminate\View\View
     */ 
    public function index(Folder $folder)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = $folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            //選択したフォルダのIDを受け取り、view関数でテンプレートに渡す
            'current_folder_id' => $folder->id,
            //選択したフォルダに紐づかれたタスクをview関数でテンプレートに渡す
            'tasks' => $tasks,
        ]);
    }

    /** 
     * 入力フォームを表示するためのルートを実装する 
     * @param Folder $folder
     * @return \Illuminate\View\View
     */ 
    public function showCreateForm(Folder $folder) 
    { 
        // URL（/folders/{id}/tasks/create）を作るためのフォルダIDをの引数で受け取る 
        return view('tasks/create', [
             'folder_id' => $folder->id,
        ]); 
    }

    /**
     * タスクを保存するcreateメソッドを追加する
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        // タスクモデルのインスタンスを作成
        $task = new Task();
        // タイトルと期限日の入力値を代入する
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        /** 
         * タスクを作成するルートに画面の出力は必要ないので、フォルダに紐づくタスクをタスク一覧画面に
         * redirectメソッドを呼び出し偏移させる
         */
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     * タスクを編集するshowEditFormメソッドを追加する
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View  
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        // チェックの処理をメソッドに切り出す
        $this->checkRelation($folder, $task);

        // タスク編集テンプレートにタスクデータを渡す
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        // チェックの処理をメソッドに切り出す
        $this->checkRelation($folder, $task);

        // タイトルと期限日、状態の入力値を代入する
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        // タスクを保存する
        $task->save();

        /** 
         * タスクを作成するルートに画面の出力は必要ないので、フォルダに紐づくタスクをタスク一覧画面に
         * redirectメソッドを呼び出し偏移させる
         */
        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    // タスクとフォルダの紐づきを確認し、紐づいていなければ404エラーを返すメソッド
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
