<?php

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{

    protected $divisions = [
        [
            'id' => 1,
            'name' => 'Άνδρες'
        ],
        [
            'id' => 2,
            'name' => 'Γυναίκες'
        ],
        [
            'id' => 3,
            'name' => 'Αγόρια'
        ],
        [
            'id' => 4,
            'name' => 'Κορίτσια'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->divisions as $division) {
            DB::table('divisions')->insert([
                'id' => $division['id'],
                'name' => $division['name']
            ]);
        }
    }
}
