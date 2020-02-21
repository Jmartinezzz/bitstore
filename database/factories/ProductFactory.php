<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,3),
        'supplier_id' => $faker->numberBetween(1,5),
        'productName' => $faker->text(15),
        'stock' => $faker->numberBetween(10,40),
        'purchasePrice' => $faker->randomFloat(2,2,100),
        'saleprice' => $faker->randomFloat(2,1,100),
        'description' => $faker->text,
    ];
});
