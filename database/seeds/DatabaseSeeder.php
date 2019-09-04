<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTaskSeeder::class);
       /* DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);*/

        /*DB::table('tasks')->insert([
            'user_id' => 4,
            'task_name' => Str::random(30)
        ]);*/
    }
}
