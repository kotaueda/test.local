<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Task;
use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // CreateTaskのrulesメソッドを変数$ruleに代入する
        $rule = parent::rules();

        // 入力値が許可リストに含まれているかを検証するinルールを使用し、配列として取得する
        $status_rule = Rule::in(array_keys(Task::STATUS));

        // CreateTaskのrulesメソッドの結果と合わせたルールリストを返す
        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    // CreateTaskのattributesメソッドの結果と合わせた属性名リストを返す
    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        // CreateTaskのmessagesメソッドを変数$ruleに代入する
        $messages = parent::messages();

        // array_mapを使って要素にコールバック関数を適用した結果をまとめた配列を返す
        // statusの各要素からlabelキーを取り出す
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        // implodeメソッドを使って配列の属性のキーと値の間に挟みたい文字列を指定する
        $status_labels = implode('、', $status_labels);

        // CreateTaskのmessagesメソッドの結果と合わせたメッセージリストを返す
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}