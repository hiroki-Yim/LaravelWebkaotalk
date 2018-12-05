<?php

use Faker\Generator as Faker;

$factory->define(App\Friend::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween($min = 15, $max = 24),
        'friend_id' => $faker->numberBetween($min = 15, $max = 24),
    ];
});
