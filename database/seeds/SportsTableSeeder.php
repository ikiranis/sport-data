<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    protected $sports = [
        'Ποδόσφαιρο', 'Μπάσκετ', 'Βόλει', 'Χαντμπολ'
    ];

    protected $id;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->sports as $sport) {
            $this->id = Str::uuid();

            DB::table('sports')->insert([
                'id' => $this->id,
                'name' => $sport,
                'slug' => str_slug($sport)
            ]);

            factory(App\Championship::class, 5)->create([
                'sport_id' => $this->id
            ])->each(function ($championship) {

                factory(App\Season::class)->create([
                    'championship_id' => $championship->id
                ])->each(function ($season) {
                    factory(App\Matchday::class, 10)->create([
                        'season_id' => $season->id
                    ]);
                });

                factory(App\Team::class, 8)->create([
                    'sport_id' => $this->id,
                    'championship_id' => $championship->id
                ]);

            });



        }


    }
}
