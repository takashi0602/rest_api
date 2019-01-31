<?php

use Illuminate\Database\Seeder;
use App\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Task::create(["name" => "牛乳を買う"]);
        Task::create(["name" => "本を読む"]);
        Task::create(["name" => "部屋を掃除する"]);
        // $this->call(UsersTableSeeder::class);
    }
}
