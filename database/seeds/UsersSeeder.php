<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Staff;

class UsersSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 5)->create();
        $staffs = factory(Staff::class, 5)->create();
    }
}
