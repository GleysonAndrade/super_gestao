<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SiteContato;
use Faker\Generator as Faker;

//ver de como usar para cada atributo como nome, telefone no link da documentação
//https://github.com/fzaninotto/Faker

$factory->define(SiteContato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'telefone' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,
        'motivo_contato' => $faker->numberBetween(1,3),
        'mensagem' => $faker->text(200)
    ];
});
