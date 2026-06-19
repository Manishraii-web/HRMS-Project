<?php

namespace App\Providers;

use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings =[
        DepartmentRepositoryInterface::class => DepartmentRepository::class,
        EmployeeRepositoryInterface::class => EmployeeRepository::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
