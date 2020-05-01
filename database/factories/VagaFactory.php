<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vaga;
use Faker\Generator as Faker;

$factory->define(Vaga::class, function (Faker $faker) {
    $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));
    return [
        'titulo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'descricao' => $faker->text,
        'expediente' => $faker->buildingNumber,
        'salario' => $faker->buildingNumber,
        'horario' => $faker->time($format = 'H:i:s', $max = 'now'),
        'beneficios' => $faker->text,
        'divulgar_ate' =>$faker->date,   
    ];
});


