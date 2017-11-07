<?php

use Faker\Generator as Faker;
use App\Post;
use App\Section;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(120),
        'body' => $faker->realText(1000),
        'section_id' => Section::inRandomOrder()->first()->id,
    ];
});
