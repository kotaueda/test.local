<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task; //Taskモデルを読み込む
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        //すべてのフォルダを取得する
        $folders = Folder::all();

        //選択したフォルダを取得する
        $current_folder = Folder::find($id);

        //選択したフォルダに紐づかれたタスクを取得する
        $tasks = Task::where('folder_id', $current_folder->id)->get();

        return view('tasks/index', [
            'folders' => $folders,
            //選択したフォルダのIDを受け取り、view関数でテンプレートに渡す
            'current_folder_id' => $current_folder->id,
            //選択したフォルダに紐づかれたタスクをview関数でテンプレートに渡す
            'tasks' => $tasks,
        ]);
    }
}
