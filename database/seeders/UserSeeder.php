<?php

namespace Database\Seeders;

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
            'name' => 'Administrador',
            'email' => 'semiramis@seekers-mexico.com.mx',
            'password' => bcrypt('g3seeker5')
        ])->assignRole('Admin');

        User::create([
            'name' => 'administradordesistema',
            'email' => 'soporteinformatico@seekers-mexico.com.mx',
            'password' => bcrypt('melilove')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Cobranza',
            'email' => 'cobranza@seekers-mexico.com.mx',
            'password' => bcrypt('cobranza')
        ])->assignRole('Cobranza');


        User::create([
            'name' => 'Contabilidad',
            'email' => 'contabilidad@seekers-mexico.com.mx',
            'password' => bcrypt('contabilidad')
        ])->assignRole('Contabilidad');

        User::create([
            'name' => 'Operaciones',
            'email' => 'operaciones@seekers-mexico.com.mx',
            'password' => bcrypt('operaciones')
        ])->assignRole('Operaciones');

        User::create([
            'name' => 'Monitoreo',
            'email' => 'monitoreo@seekers-mexico.com.mx',
            'password' => bcrypt('monitoreo')
        ])->assignRole('Monitoreo');
    }
}
