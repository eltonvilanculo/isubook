<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estudante;
use Faker\Generator as Faker;

$factory->define(Estudante::class, function (Faker $faker) {
    return [
        //
        'nome'=>$faker->name(),
        'celular'=>$faker->phoneNumber(),
        'email'=>$faker->email(),
        'endereco'=>$faker->city(),
        'estado'=>$faker->randomElement(['pendente','matriculado','dispensado']),
        'genero'=>$faker->randomElement(['masculino','feminino','outro']),
        'data_nascimento' =>$faker->dateTimeBetween('-30 years','-20 years')


    ];
});