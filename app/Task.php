<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // statusのlabelの値を文字列への変更し定義
    // 配列にクラスを追加する
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
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

    // statusの色分けを取得するためのメソッド
    public function getStatusClassAttribute()
    {
        // statusカラムの値を取得
        $status = $this->attributes['status'];

        // isset関数で変数に値が入っているかをチェックする
        if (!isset(self::STATUS[$status])) {
            return ''; //　空だった場合は空文字を返す
        }

        // statusカラムの値へアクセス
        return self::STATUS[$status]['class'];
    }
}
