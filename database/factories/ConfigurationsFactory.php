<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Configurations::class, function (Faker $faker) {
    return [
        'v_url' => $faker->word,
        'v_site_url' => $faker->word,
        'v_content_type' => $faker->word,
        'v_filter_type' => $faker->word,
        'v_function' => $faker->word,
    ];
});
