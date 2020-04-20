<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    /**
     * 各テストメソッドの実行前に呼ばれる
     * voidで戻り値の型を返すとエラーになる
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /**
     * 期限日が日付ではない場合はバリデーションエラーを返す
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, // 不正なデータ（数値）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラーを返す
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), // 不正なデータ（昨日の日付）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }

    /**
     * 期限日が日付だった場合はタスク一覧ページへリダイレクトする
     * @test
     */
    public function due_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => '2020/04/30', // 正常なデータ（数値）
        ]);

        $response->assertRedirect('/folders/1/tasks');
    }


     /**
     * 期限日が今日以降の場合はタスク一覧ページへリダイレクトする
     * @test
     */
    public function due_date_today()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::today()->format('Y/m/d'), // 正常なデータ（今日の日付）
        ]);

        $response->assertRedirect('/folders/1/tasks');
    }

    /**
     * 期限日がうるう年でもデータが正常に保存されるかをチェック
     * @test
     */
    public function due_date_leap()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => '2024/02/29', // 正常なうるう年のデータ（数値）
        ]);

        $response->assertRedirect('/folders/1/tasks');
    }

      /**
     *  期限日が存在しないうるう年の日付に対してエラーを返す
     * @test
     */
    public function due_date_not_leep()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => '2025/02/29', // 存在しないデータ（数値）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。',
        ]);
    }
}
