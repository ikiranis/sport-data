<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    protected $sports = [
        'Ποδόσφαιρο', 'Μπάσκετ', 'Βόλει', 'Χαντμπολ'
    ];

    protected $createdChampionships = array();

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->sports as $sport) {
            $id = Str::uuid();

            DB::table('sports')->insert([
                'id' => $id,
                'name' => $sport,
                'slug' => str_slug($sport)
            ]);

            factory(App\Championship::class, 5)->create([
                'sport_id' => $id
            ])->each(function ($championship) {

                $this->createdChampionships[] = $championship->id;

                factory(App\Season::class)->create([
                    'championship_id' => $championship->id
                ])->each(function ($season) {
                    factory(App\Matchday::class, 10)->create([
                        'season_id' => $season->id
                    ]);
                });
            });

            foreach ($this->createdChampionships as $championship_id) {
                factory(App\Team::class, 8)->create([
                    'sport_id' => $id,
                    'championship_id' => $championship_id
                ]);
            }


        }


    }
}
