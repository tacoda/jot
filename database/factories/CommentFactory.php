<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'post_id' => factory('App\Post')->create()->id
    ];
});
