<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'name'=> 'Miguel Alvarado',
            'email'=> 'mrstroke11@gmail.com',
            'password' => bcrypt('melilove')

        ]);

        User::factory(9)->create();
    }
}
