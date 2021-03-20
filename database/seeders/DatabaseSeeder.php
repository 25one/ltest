<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $keyCharacter) {
            \DB::table('characters')->insert([
                'name' => $faker->firstName,
                'birthday' => $faker->date($format = 'Y-m-d', $max = '-10 years'),
                'occupations' => json_encode($faker->sentences($nb = 3, $asText = false)),
                'img' => $faker->imageUrl,
                'nickname' => $faker->lastName,
                'portrayed' => $faker->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }        
        foreach (range(1,30) as $keyEpisode) {
            \DB::table('episodes')->insert([
                'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'air_date' => $faker->date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $arrayCharacter = [];
            for ($i = 1; $i <= rand(5, 15); ++$i) {
                while (true) {
                   $value = rand(1, 100);
                   if (! array_search($value, $arrayCharacter)) {
                       $arrayCharacter[] = $value;
                       for ($j = 1; $j <= rand(3, 7); ++$j) {
                         \DB::table('quotes')->insert([
                             'episode_id' => $keyEpisode,
                             'character_id' => $value,
                             'quote' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                             'created_at' => Carbon::now(),
                             'updated_at' => Carbon::now(),
                         ]);
                       }
                       break;
                   }
                }
            }
            for ($i = 0; $i < count($arrayCharacter); ++$i) {
                \DB::table('character_episode')->insert([
                    'episode_id' => $keyEpisode,
                    'character_id' => $arrayCharacter[$i],
                ]);
            }
        }      
    }
}
