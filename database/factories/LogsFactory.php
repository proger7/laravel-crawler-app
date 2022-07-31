<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Logs::class, function (Faker $faker) {
    return [
        'v_status' => $faker->word,
        'n_parsed_qua' => $faker->randomNumber(),
        'v_url' => $faker->word,
        'v_site_url' => $faker->word,
        'v_content_type' => $faker->word,
        'v_comment' => $faker->word,
        'v_command' => $faker->word,
    ];
});
