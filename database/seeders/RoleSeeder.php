<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Usuario']);

        
        Permission::create(['name'=> 'admin.index']);
        Permission::create(['name'=> 'admin.users']);
        Permission::create(['name'=> 'referencia.index']);
        Permission::create(['name'=> 'referencia.create']);
        Permission::create(['name'=> 'referencia.edit']);
        Permission::create(['name'=> 'referencia.destroy']);

        Permission::create(['name'=> 'cliente.index']);
        Permission::create(['name'=> 'cliente.create']);
        Permission::create(['name'=> 'cliente.edit']);
        Permission::create(['name'=> 'cliente.destroy']);
        Permission::create(['name'=> 'cliente.show']);

        Permission::create(['name'=> 'cuenta.index']);
        Permission::create(['name'=> 'cuenta.create']);
        Permission::create(['name'=> 'cuenta.edit']);
        Permission::create(['name'=> 'cuenta.destroy']);


        Permission::create(['name'=> 'vehiculo.index']);
        Permission::create(['name'=> 'vehiculo.create']);
        Permission::create(['name'=> 'vehiculo.edit']);
        Permission::create(['name'=> 'vehiculo.destroy']);

        
        Permission::create(['name'=> 'dispositivo.index']);
        Permission::create(['name'=> 'dispositivo.create']);
        Permission::create(['name'=> 'dispositivo.edit']);
        Permission::create(['name'=> 'dispositivo.destroy']);

        Permission::create(['name'=> 'linea.index']);
        Permission::create(['name'=> 'linea.create']);
        Permission::create(['name'=> 'linea.edit']);
        Permission::create(['name'=> 'linea.destroy']);

        Permission::create(['name'=> 'sensor.index']);
        Permission::create(['name'=> 'sensor.create']);
        Permission::create(['name'=> 'sensor.edit']);
        Permission::create(['name'=> 'sensor.destroy']);
    }
}
