<?php

use App\Estudante;
use App\User;
use Illuminate\Database\Seeder;

class DataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(App\User::class,1)->create();
        factory(Estudante::class,130)->create();
    }
}