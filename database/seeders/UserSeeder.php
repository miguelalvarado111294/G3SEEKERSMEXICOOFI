<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'=>'Administrador',
            'email' => 'administrador@seekers-mexico.com.mx',
            'password'=> bcrypt('g3seeker5')
        ])->assignRole('Admin');
    }
}
