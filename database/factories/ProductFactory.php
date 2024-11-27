<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'upc' => $faker->numberBetween(10000,50000),
        'description' => $faker->sentence(10),
        'brand_id' => $faker->numberBetween(1,5),
        'product_type_id' => $faker->numberBetween(1,5),
        'status' => 1,
    ];
});
