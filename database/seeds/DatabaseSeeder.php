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
        DB::table('teams')->truncate();

        factory(App\Athlete::class, 50)->create();
        factory(App\Stadium::class, 50)->create();
        factory(App\Team::class, 50)->create();
    }
}
