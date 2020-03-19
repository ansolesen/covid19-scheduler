<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Survey;
use Faker\Generator as Faker;

$factory->define(Survey::class, function (Faker $faker) {
    $value = new StdClass();
    $value->name = $faker->name;
    return [
        'id' => $faker->unique(true)->text(10),
        'value' => json_encode(json_encode($value)),
        'created_on' => $faker->dateTime(),
        'modified_on' => $faker->dateTime(),
        'date' => $faker->date(),
        'person' => $faker->numberBetween()
    ];
});
