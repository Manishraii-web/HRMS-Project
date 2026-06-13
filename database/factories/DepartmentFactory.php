<?php

namespace Database\Factories;

use App\Enums\DepartmentStatus;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $name = fake()->unique()->randomElement([
                'Human Resources','Engineering','Finance', 'Marketing',
            'Sales', 'Operations', 'IT Support', 'Legal',
            'Customer Success', 'Research & Development',
            ]);
            return  [
                'tenant_id'=>1,
                'name' => $name,
                'code' => strtoupper(substr(str_replace([' ','&'],'',$name),0,6)) . fake()->numberBetween(10, 99),
                'description'=>fake()->sentence(10),
                'status' => fake()->randomElement([
                DepartmentStatus::Active,
                DepartmentStatus::Active,
                DepartmentStatus::Active,
                DepartmentStatus::Inactive,
            ]),
         ];
    }
}
