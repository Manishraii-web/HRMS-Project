<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

       $permissions =[
        'departments.view',
        'departments.create',
        'departments.update',
        'departments.deactivate',

        'employees.view',
        'employees.create',
        'employees.update',
        'employees.deactivate',
       ];

       foreach($permissions as $permission)
        {
            Permission::firstOrCreate(['name' => $permission, 'guard_name'=> 'web']);
        }
        $admin = Role::firstOrCreate(['name'=>'admin', 'guard_name'=> 'web']);
        $hr = Role::firstOrCreate(['name' => 'hr', 'guard_name' => 'web']);
        $employee = Role::firstOrCreate(['name' =>'employee', 'guard_name' => 'web']);

        $admin->syncPermissions($permissions);
        $hr->syncPermissions($permissions);

        $employee->syncPermissions([
            'employees.view',
        ]);
    }
}
