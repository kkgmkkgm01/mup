<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fakerを使う
        $faker = Faker\Factory::create('ja_JP');
        // ランダムにアイテムを作成
        for ($i = 0; $i < 100; $i++)
        {
            DB::table('items')->insert(
                [
                'key' => $faker->unique()->regexify('[a-z1-9]{10}'),
                'name' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'volume' => $faker->numberBetween($min = 100, $max = 2000),
                'price' => $faker->numberBetween($min = 100, $max = 5000),
                'per_gram_carolie' => $faker->numberBetween($min = 100, $max = 200),
                'calorie' => $faker->numberBetween($min = 0, $max = 200),
                'per_gram_carb' => $faker->numberBetween($min = 100, $max = 200),
                'carb' => $faker->numberBetween($min = 0, $max = 200),
                'per_gram_protein' => $faker->numberBetween($min = 100, $max = 200),
                'protein' => $faker->numberBetween($min = 0, $max = 200),
                'per_gram_fat' => $faker->numberBetween($min = 100, $max = 200),
                'fat' => $faker->numberBetween($min = 0, $max = 200),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                ]
            );
        }
    }
}
