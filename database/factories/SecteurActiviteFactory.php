<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SecteurActivite;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(SecteurActivite::class, function (Faker $faker) {
    $title = $faker->sentence(rand(5,10));
    $uuid = Str::uuid()->toString();
    return [
        'title' => $title,
        'uuid' => $uuid,
        'slug' => Str::slug($title),
        'description' => $faker->paragraph(rand(100,300)),
        
    ];
});
