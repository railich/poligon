<?php

use Faker\Generator as Faker;

$factory->define(App\Models\BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $is_published = rand(1, 5) > 1;
    $created_at = $faker->dateTimeBetween('-3 month', '-2 month');

    $data = [
        'category_id' => rand(1, 11),
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'title' => $title,
        'slug' => str_slug($title),
        'excerpt' => $faker->text(rand(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $is_published,
        'published_at' => $is_published ? $faker->dateTimeBetween('-2 month', '-1 days') : null,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
    return $data;
});
