<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Offre;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Offre::class, function (Faker $faker) {
    $title = $faker->sentence(rand(5,10));
    $uuid = Str::uuid()->toString();
    return [
        'title' => $title,
        'uuid' => $uuid,
        'slug' => Str::slug($title),
        'text' => $faker->paragraph(rand(200,500)),
        'user_id' => $faker->randomDigit(1,10),
        'sector_id' => $faker->randomDigit(1,10),
        'published_by' => $faker->randomDigit(1,10),
        'is_published' => $faker->boolean(),
    ];
});
