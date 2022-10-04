<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Users;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Users::class, function (Faker $faker) {
    return [
        //
        'name' => 'Archad',
        'email' => 'archad@gmail.com',
        'password' =>Hash::make('12345678')
        
    ];
});