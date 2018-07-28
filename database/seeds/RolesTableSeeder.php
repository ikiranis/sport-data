<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    protected $roles = [
        [
            'id' => 1,
            'name' => 'Administrator'
        ],
        [
            'id' => 2,
            'name' => 'Subscriber'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->roles as $role) {
            DB::table('roles')->insert([
                'id' => $role['id'],
                'name' => $role['name']
            ]);
        }


    }
}
