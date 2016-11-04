<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });


/**
 *  User Factory
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'is_admin' => false,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'product_name' => $faker->word,
        'product_description' => $faker->sentence(10, true),
    ];
});


/**
 *	Product Factory
 */

$factory->define(App\Product::class, function (Faker\Generator $faker) {
	return [
		'user_id' => rand(1, 20),
		'category_id' => rand(1, 20),
		'product_name' => $faker->word,
		'product_description' => $faker->sentence(10, true),
	];
});

/**
 *  Category Factory
 */

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'category_name' => $faker->word,
        'category_description' => $faker->sentence(10, true),
    ];
});

















