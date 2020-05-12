<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // トップページを表示するためのコントローラーを設定する
    public function index()
    {
        return view('home');
    }
}