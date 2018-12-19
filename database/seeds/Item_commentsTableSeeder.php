<?php

use Illuminate\Database\Seeder;

class Item_commentsTableSeeder extends Seeder
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
        for ($i = 0; $i < 5000; $i++)
        {
            DB::table('item_comments')->insert(
                [
                'item_id' => $i%100+1,
                'user_id' => 1,
                'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                ]
            );
        }
    }
}
