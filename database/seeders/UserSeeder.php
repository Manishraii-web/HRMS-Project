<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tenantId= 1;

       $admin=User::firstOrCreate(
        ['email'=>'admin@gmail.com' ,
        'name'=>'Villainsama',
        'password'=>Hash::make('password'),
        'tenant_id' => $tenantId,
        'email_verified_at' => now(),
      ]
      );

      $admin->syncRoles(['admin']);

      $hr= User::firstOrCreate(
        ['email' => 'hr@gmail.com'],
        [
            'name' => 'HRSama',
            'password' => Hash::make('password'),
            'tenant_id' => $tenantId,
            'email_verified_at' => now(),
        ]
      );
      $hr->syncRoles(['hr']);

      $employee= User::firstOrCreate(
        ['email' => 'employee@gmail.com'],
        [
            'name' => 'EmployeeSama',
            'password' => Hash::make('password'),
            'tenant_id' => $tenantId,
            'email_verified_at' => now(),
        ]
      );
      $employee->syncRoles(['employee']);

    }
}
