<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'owner_id' => factory('App\User')->create()->id,
        'title' => $faker->sentence,
        'content' => $faker->paragraph
    ];
});
