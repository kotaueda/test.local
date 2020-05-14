<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompletionController extends Controller
{
    // 登録完了ページを表示するためのコントローラーを設定する
    public function index()
    {
        return view('completion');
    }
}