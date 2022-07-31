<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'is_admin' => $faker->boolean,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
        'deleted_at' => $faker->dateTimeBetween(),
    ];
});
