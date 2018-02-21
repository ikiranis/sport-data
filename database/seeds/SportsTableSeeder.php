<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    protected $sports = [
        'Ποδόσφαιρο', 'Μπάσκετ', 'Βόλει', 'Χαντμπολ'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->sports as $sport) {
            DB::table('sports')->insert([
                'name' => $sport,
                'slug' => str_slug($sport)
            ]);
        }


    }
}
