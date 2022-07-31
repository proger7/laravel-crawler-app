<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'category_type' => $faker->word,
        'v_site_url' => $faker->word,
        'alias' => $faker->word,
        'name' => $faker->name,
        'link' => $faker->word,
    ];
});
