<?php

use Illuminate\Database\Seeder;

class Posts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            App\Post::create([
              'title' => $faker->realText(100),
              'body' => $faker->realText()
            ]);
        }
    }
}
