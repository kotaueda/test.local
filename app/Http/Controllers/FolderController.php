<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FolderController extends Controller
{
    // フォルダのフォームを表示画面をビューテンプレートへ返す
    public function showCreateForm()
    {
        return view('folders/create');
    }
}
