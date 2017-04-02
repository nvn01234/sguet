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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Contact::class, function(\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence(3),
        'phone_cq' => $faker->phoneNumber,
        'phone_nr' => $faker->phoneNumber,
        'phone_dd' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'email' => $faker->email,
        'parent_id' => \App\Contact::all()->count() > 0 ? \App\Contact::all()->random()->id : null
    ];
});