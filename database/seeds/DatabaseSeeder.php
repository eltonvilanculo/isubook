<?php

use App\ProductCategory;
use App\Provinces;
use App\Route;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        // factory(User::class,25)->create();

    User::insert([

            [
            'name'=>'Admin',
            'email'=>'eltonvillas10@gmail.com',
            'password'=>Hash::make('12345678'),
            'type'=>0,
            ],

        ]);

        Route::create([
            'name'=>'Maputo-Xai'
        ]);




    //     ProductCategory::insert([

    //         [
    //             'name'=>'Livro'
    //         ],
    //         [
    //             'name'=>'PFC'
    //         ]
    //     ]);


    }
}
