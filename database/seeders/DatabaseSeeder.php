<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     $tenant=  Tenant::create([
        'name' =>'Default Company',
        'slug' => 'default-company',
        'status' => 'active',
      ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'tenant_id' => $tenant->id,
        ]);

    $this->call([
        DepartmentSeeder::class,
    ]);

    $this->call([
        RolePermissionSeeder::class,
    ]);

    $this->call([
        UserSeeder::class,
    ]);

    }
}
