<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
        'subcategory_id' => $faker->randomNumber(),
        'name' => $faker->randomLetter,
        'hmotnost' => $faker->randomNumber()
        
    ];
});
