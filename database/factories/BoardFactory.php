<?php

use Faker\Generator as Faker;
use App\user;

$factory->define(App\Board::class, function (Faker $faker) {

    return [
        'author'=>"林弘基",
        'title'=>$faker->firstNameMale,
        'content'=>$faker->realText,
    ];
});
