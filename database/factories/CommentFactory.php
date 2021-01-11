<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Comment::class, function (Faker $faker) {
    $uuid = Str::uuid()->toString();
    return [
        'uuid' => $uuid,
        'text' => $faker->paragraph(rand(100,300)),
        'user_id' => $faker->randomDigit(1,10),
        'post_id' => $faker->randomDigit(1,10),
        
    ];
});
