<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\NodeImage::class, function (Faker $faker) {
    return [
        'n_product_id' => $faker->randomNumber(),
        'v_product_url' => $faker->word,
        'v_gallery_item' => $faker->text,
        'v_parsing_type' => $faker->word,
    ];
});
