<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RolesTableSeeder::class);

        // First, clear tables
        DB::table('stadia')->truncate();
        DB::table('athletes')->truncate();

        factory(App\Athlete::class, 10)->create();
        factory(App\Stadium::class, 10)->create();
    }
}
