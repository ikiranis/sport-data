<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'rocean',
            'email' => 'rocean74@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
            'api_token' => str_random(60),
        ]);
    }
}
