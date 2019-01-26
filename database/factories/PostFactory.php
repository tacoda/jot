<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'owner_id' => 1,
        'title' => $faker->sentence,
        'content' => $faker->text
    ];
});
