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

        // First, clear tables
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('sports')->truncate();
        DB::table('stadia')->truncate();
        DB::table('athletes')->truncate();
        DB::table('teams')->truncate();
        DB::table('seasons')->truncate();
        DB::table('championships')->truncate();
        DB::table('matchdays')->truncate();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SportsTableSeeder::class);

        factory(App\Athlete::class, 50)->create();
        factory(App\Stadium::class, 50)->create();
        factory(App\Team::class, 50)->create();
        factory(App\Matchday::class, 20)->create();
    }
}
