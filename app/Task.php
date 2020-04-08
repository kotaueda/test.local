<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // statusのlabelの値を文字列への変更し定義
    const STATUS = [
        1 => [ 'label' => '未着手'],
        2 => [ 'label' => '着手中'],
        3 => [ 'label' => '完了'],
    ];

    // statusの文字列を取得するためのメソッド
    public function getStatusLabelAttribute()
    {
        // statusカラムの値を取得
        $status = $this->attributes['status'];

        // isset関数で変数に値が入っているかをチェックする
        if (!isset(self::STATUS[$status])) {
            return ''; //　空だった場合は空文字を返す
        }

        // statusカラムの値へアクセス
        return self::STATUS[$status]['label'];
    }
}
