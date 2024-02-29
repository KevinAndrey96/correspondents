<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Ver top tenderos']);
        Permission::create(['name' => 'Ver roles y permisos']);
        Permission::create(['name' => 'Ver configuracion']);
        Permission::create(['name' => 'Ver usuarios']);
        Permission::create(['name' => 'Ver grupo de productos']);
        Permission::create(['name' => 'Ver comisiones']);
        Permission::create(['name' => 'Ver transacciones']);
        Permission::create(['name' => 'Ver saldos']);
        Permission::create(['name' => 'Ver ganancias']);
        Permission::create(['name' => 'Ver footer proveedor']);
        Permission::create(['name' => 'Ver footer administador']);
        Permission::create(['name' => 'Ver tenderos de distribuidor']);
        Permission::create(['name' => 'Ver todos los tenderos']);
        Permission::create(['name' => 'Ver comisiones desplegable']);
        Permission::create(['name' => 'Ver contactar distribuidor']);
        Permission::create(['name' => 'Ver ultimas transacciones']);
        Permission::create(['name' => 'Ver todas las transacciones']);
        Permission::create(['name' => 'Ver nueva transaccion']);
        Permission::create(['name' => 'Ver nuevo giro']);
        Permission::create(['name' => 'Ver mis transacciones']);
        Permission::create(['name' => 'Ver transacciones en espera']);
        Permission::create(['name' => 'Ver historial de transacciones']);
        Permission::create(['name' => 'Ver recargar saldo']);
        Permission::create(['name' => 'Ver historial de saldos']);
        Permission::create(['name' => 'Ver historial de solicitudes de saldos']);
        Permission::create(['name' => 'Ver solicitudes de saldo']);
        Permission::create(['name' => 'Ver saldo por usuario']);
        Permission::create(['name' => 'Ver solicitudes de ganancias']);
        Permission::create(['name' => 'Ver retirar ganancias']);
        Permission::create(['name' => 'Ver historial retiros ganancia']);
        Permission::create(['name' => 'Ver grupos de comisiones']);

        $role = Role::findByName('Administrator');
        $role->givePermissionTo('Ver top tenderos');
        $role->givePermissionTo('Ver roles y permisos');
        $role->givePermissionTo('Ver configuracion');
        $role->givePermissionTo('Ver usuarios');
        $role->givePermissionTo('Ver grupo de productos');
        $role->givePermissionTo('Ver saldos');
        $role->givePermissionTo('Ver transacciones');
        $role->givePermissionTo('Ver ganancias');
        $role->givePermissionTo('Ver footer administador');
        $role->givePermissionTo('Ver ultimas transacciones');
        $role->givePermissionTo('Ver todas las transacciones');
        $role->givePermissionTo('Ver historial de solicitudes de saldos');
        $role->givePermissionTo('Ver todos los tenderos');
        $role->givePermissionTo('Ver solicitudes de saldo');
        $role->givePermissionTo('Ver saldo por usuario');
        $role->givePermissionTo('Ver solicitudes de ganancias');
        $role->givePermissionTo('Ver retirar ganancias');
        $role->givePermissionTo('Ver historial retiros ganancia');


        $role = Role::findByName('Supplier');
        $role->givePermissionTo('Ver comisiones');
        $role->givePermissionTo('Ver saldos');
        $role->givePermissionTo('Ver transacciones');
        $role->givePermissionTo('Ver ganancias');
        $role->givePermissionTo('Ver footer proveedor');
        $role->givePermissionTo('Ver retirar ganancias');
        $role->givePermissionTo('Ver historial retiros ganancia');
        $role->givePermissionTo('Ver transacciones en espera');
        $role->givePermissionTo('Ver historial de transacciones');
        $role->givePermissionTo('Ver recargar saldo');
        $role->givePermissionTo('Ver historial de saldos');

        $role = Role::findByName('Shopkeeper');
        $role->givePermissionTo('Ver comisiones');
        $role->givePermissionTo('Ver saldos');
        $role->givePermissionTo('Ver transacciones');
        $role->givePermissionTo('Ver ganancias');
        $role->givePermissionTo('Ver retirar ganancias');
        $role->givePermissionTo('Ver historial retiros ganancia');
        $role->givePermissionTo('Ver contactar distribuidor');
        $role->givePermissionTo('Ver nueva transaccion');
        $role->givePermissionTo('Ver nuevo giro');
        $role->givePermissionTo('Ver mis transacciones');
        $role->givePermissionTo('Ver recargar saldo');
        $role->givePermissionTo('Ver historial de saldos');

        $role = Role::findByName('Distributor');
        $role->givePermissionTo('Ver ganancias');
        $role->givePermissionTo('Ver tenderos de distribuidor');
        $role->givePermissionTo('Ver comisiones desplegable');
        $role->givePermissionTo('Ver grupos de comisiones');
        $role->givePermissionTo('Ver retirar ganancias');
        $role->givePermissionTo('Ver historial retiros ganancia');

        $role = Role::create(['name' => 'Saldos']);
        $role->givePermissionTo('Ver ganancias');
        $role->givePermissionTo('Ver saldos');
        $role->givePermissionTo('Ver solicitudes de saldo');
        $role->givePermissionTo('Ver historial de solicitudes de saldos');
        $role->givePermissionTo('Ver saldo por usuario');
        $role->givePermissionTo('Ver solicitudes de ganancias');
        $role->givePermissionTo('Ver historial retiros ganancia');

    }
}
