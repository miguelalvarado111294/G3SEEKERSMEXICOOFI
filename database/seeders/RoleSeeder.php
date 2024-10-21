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
        $role2 = Role::create(['name' => 'Monitoreo']); //no pueder ver o agregar 
        $role3 = Role::create(['name' => 'Cobranza']);
        $role4 = Role::create(['name' => 'Contabilidad']);
        $role5 = Role::create(['name' => 'Operaciones']);

        //administracion
        Permission::create(['name' => 'admin.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.edit'])->syncRoles([$role1]);

        //cliente

        Permission::create(['name' => 'cliente.index'])->syncRoles([$role1, $role2, $role3]);  //Cobranza    Monitoreo
        Permission::create(['name' => 'cliente.show'])->syncRoles([$role1, $role2, $role3]);   //Cobranza   Monitoreo 
        Permission::create(['name' => 'cliente.create'])->syncRoles([$role1, $role3]);  //Cobranza 
        Permission::create(['name' => 'cliente.edit'])->syncRoles([$role1, $role3]);  //Cobranza 
        Permission::create(['name' => 'cliente.destroy'])->syncRoles([$role1]);  //administrador 
        //refeerencias

        Permission::create(['name' => 'referencia.index'])->syncRoles([$role1, $role2]); //Cobranza  

        Permission::create(['name' => 'referencia.create'])->syncRoles([$role1, $role3]); //Cobranza  
        Permission::create(['name' => 'referencia.edit'])->syncRoles([$role1, $role3]);  //Cobranza  
        Permission::create(['name' => 'referencia.destroy'])->syncRoles([$role1]);
        //cuenta

        Permission::create(['name' => 'cuenta.index'])->syncRoles([$role1, $role2, $role3]); //Cobranza 
        Permission::create(['name' => 'cuenta.create'])->syncRoles([$role1, $role3]); //Cobranza  
        Permission::create(['name' => 'cuenta.edit'])->syncRoles([$role1, $role3]);  //Cobranza  
        Permission::create(['name' => 'cuenta.destroy'])->syncRoles([$role1]);
        //vehiculo

        Permission::create(['name' => 'vehiculo.index'])->syncRoles([$role1, $role2 ,$role3]); //Cobranza 
        Permission::create(['name' => 'vehiculo.create'])->syncRoles([$role1, $role3]); //Cobranza  
        Permission::create(['name' => 'vehiculo.edit'])->syncRoles([$role1, $role3]);  //Cobranza  
        Permission::create(['name' => 'vehiculo.destroy'])->syncRoles([$role1]);
        //dispositivo
        //operaciones para generar formato de servicio
        Permission::create(['name' => 'dispositivo.index'])->syncRoles([$role1, $role2, $role3]); //Cobranza 
        Permission::create(['name' => 'dispositivo.create'])->syncRoles([$role1, $role3]); //Cobranza  
        Permission::create(['name' => 'dispositivo.edit'])->syncRoles([$role1, $role3]);  //Cobranza  
        Permission::create(['name' => 'dispositivo.destroy'])->syncRoles([$role1, $role3]);
        //linea

        Permission::create(['name' => 'linea.index'])->syncRoles([$role1, $role2, $role3]); //Cobranza 
        Permission::create(['name' => 'linea.create'])->syncRoles([$role1, $role3]); //Cobranza  
        Permission::create(['name' => 'linea.edit'])->syncRoles([$role1, $role3]);  //Cobranza  
        Permission::create(['name' => 'linea.destroy'])->syncRoles([$role1]);
        //sensor

        Permission::create(['name' => 'sensor.index'])->syncRoles([$role1, $role2, $role3]); //Cobranza 
        Permission::create(['name' => 'sensor.create'])->syncRoles([$role1, $role3]); //Cobranza  
        Permission::create(['name' => 'sensor.edit'])->syncRoles([$role1, $role3]);  //Cobranza  
        Permission::create(['name' => 'sensor.destroy'])->syncRoles([$role1]);
    }
}
