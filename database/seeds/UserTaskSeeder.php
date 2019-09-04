<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\User;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(User::class, 2)->create();
        factory(Task::class, 10)->create();
    }
}
