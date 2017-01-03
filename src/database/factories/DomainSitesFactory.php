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
$factory->define(Paupenin\DomainSites\Domain::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->domainName,
        'default_locale' => $faker->languageCode,
        'site_id' => factory(Paupenin\DomainSites\Site::class)->create()->id
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Paupenin\DomainSites\Site::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company .' '. $faker->companySuffix
    ];
});
