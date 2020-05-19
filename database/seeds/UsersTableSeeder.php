<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // シーダーを用いてデータベースにテストデータを挿入する
    public function run()
    {
        // userインスタンスを１０個作成し、データベースへ保存する
        factory(App\User::class, 10)->create();
    }
}
