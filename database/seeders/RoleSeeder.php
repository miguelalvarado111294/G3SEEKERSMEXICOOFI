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
        $role2 = Role::create(['name' => 'Cobranza']); //no pueder ver o agregar 
        $role3 = Role::create(['name' => 'Operaciones']);
        $role4 = Role::create(['name' => 'Contabilidad']);
        $role5 = Role::create(['name' => 'Monitoreo']);

        //administracion
        Permission::create(['name' => 'admin.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.store'])->syncRoles([$role1]);



        //cliente
        Permission::create(['name' => 'cliente.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        
        //referencia
        Permission::create(['name' => 'referencia.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]); //Cobranza  
        Permission::create(['name' => 'referencia.create'])->syncRoles([$role1, $role2]); //Cobranza  
        Permission::create(['name' => 'referencia.edit'])->syncRoles([$role1, $role2]);  //Cobranza  
        Permission::create(['name' => 'referencia.destroy'])->syncRoles([$role1]);
        
        //cuenta
        Permission::create(['name' => 'cuenta.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]); //Cobranza 
        Permission::create(['name' => 'cuenta.create'])->syncRoles([$role1, $role2]); //Cobranza  
        Permission::create(['name' => 'cuenta.edit'])->syncRoles([$role1, $role2]);  //Cobranza  
        Permission::create(['name' => 'cuenta.destroy'])->syncRoles([$role1]);

        //vehiculo
        Permission::create(['name' => 'vehiculo.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]); //Cobranza 
        Permission::create(['name' => 'vehiculo.create'])->syncRoles([$role1, $role2]); //Cobranza  
        Permission::create(['name' => 'vehiculo.edit'])->syncRoles([$role1, $role2]);  //Cobranza  
        Permission::create(['name' => 'vehiculo.destroy'])->syncRoles([$role1]);

        //dispositivo
        Permission::create(['name' => 'dispositivo.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]); //Cobranza 
        Permission::create(['name' => 'dispositivo.create'])->syncRoles([$role1, $role2]); //Cobranza  
        Permission::create(['name' => 'dispositivo.edit'])->syncRoles([$role1, $role2]);  //Cobranza  
        Permission::create(['name' => 'dispositivo.destroy'])->syncRoles([$role1]);
        
        //linea
        Permission::create(['name' => 'linea.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]); //Cobranza 
        Permission::create(['name' => 'linea.create'])->syncRoles([$role1, $role2]); //Cobranza  
        Permission::create(['name' => 'linea.edit'])->syncRoles([$role1, $role2]);  //Cobranza  
        Permission::create(['name' => 'linea.destroy'])->syncRoles([$role1]);

        //sensor
        Permission::create(['name' => 'sensor.index'])->syncRoles([$role1, $role2, $role3, $role4, $role5]); //Cobranza 
        Permission::create(['name' => 'sensor.create'])->syncRoles([$role1, $role2]); //Cobranza  
        Permission::create(['name' => 'sensor.edit'])->syncRoles([$role1, $role2]);  //Cobranza  
        Permission::create(['name' => 'sensor.destroy'])->syncRoles([$role1]);



        Permission::create(['name' => 'crear.orden'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'crear.cita'])->syncRoles([$role1,$role3]);





    }
}
