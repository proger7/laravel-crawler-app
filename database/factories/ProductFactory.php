<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'category_id' => $faker->randomNumber(),
        'site_url' => $faker->word,
        'name' => $faker->name,
        'category_alias' => $faker->word,
        'category_url' => $faker->word,
        'category_name' => $faker->word,
        'category_type' => $faker->word,
        'price' => $faker->word,
        'v_image_name_local' => $faker->text,
        'v_image_path_local' => $faker->text,
        'main_image_url' => $faker->text,
        'image_size' => $faker->word,
        'images_urls' => $faker->word,
        'text_description' => $faker->text,
        'is_promotional' => $faker->randomNumber(),
        'is_new' => $faker->randomNumber(),
        'old_price' => $faker->word,
        'new_price' => $faker->word,
        'product_configure' => $faker->text,
        'product_content' => $faker->text,
        'url' => $faker->url,
        'v_command' => $faker->word,
    ];
});
