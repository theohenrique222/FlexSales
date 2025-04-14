<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'ver vendas']);
        Permission::firstOrCreate(['name' => 'criar clientes']);
        Permission::firstOrCreate(['name' => 'editar vendas']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $gestor = Role::firstOrCreate(['name' => 'gestor']);
        $vendedor = Role::firstOrCreate(['name' => 'vendedor']);

        $admin->givePermissionTo(Permission::all());
        $gestor->givePermissionTo(['ver vendas', 'criar clientes']);
        $vendedor->givePermissionTo(['ver vendas']);
    }
}
