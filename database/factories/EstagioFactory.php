<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estagio;
use Faker\Generator as Faker;

$factory->define(Estagio::class, function (Faker $faker) {
  
    $bolsa = ['Mensal', 'Por Hora'];
    $vt = ['Mensal','Diário'];
    $status = [
        'em_elaboracao',
        'em_analise_tecnica',
        'em_analise_academica',
        'concluido',
        'em_alteracao',
        'em_analise_tecnica_alteracao'
    ];

    return [
        'cnpj' => factory(App\Empresa::class)->create()->cnpj, 
        'numero_usp' => $faker->unique()->graduacao(),           
        'valorbolsa' => $faker->numberBetween(300, 4000),
        'tipobolsa' => $bolsa[array_rand($bolsa)],
        'justificativa' => $faker->text($maxNbChars = 200),
        'duracao' => $faker->numberBetween(12, 24),           
        'data_inicial' => $faker->date,
        'data_final' => $faker->date,
        'cargahoras' => $faker->numberBetween(00, 23),
        'cargaminutos' => $faker->numberBetween(00, 59),            
        'horario' => $faker->time($format = 'H:i', $max = 'now'), 
        'auxiliotransporte' => $faker->numberBetween(10, 300),
        'especifiquevt' => $vt[array_rand($vt)],       
        'atividades' => $faker->text($maxNbChars = 200),
        'seguradora' => $faker->company, 
        'numseguro' => $faker->unique()->numberBetween(1000, 100000), 
        'controlehorario' => $faker->text($maxNbChars = 200),
        'supervisao' => $faker->text($maxNbChars = 200),
        'interacao' => $faker->text($maxNbChars = 200),
        'enderecoedias' => $faker->text($maxNbChars = 200),
        'status' => $status[array_rand($status)],
    ];
});
