<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->decimal('basic_salary', 12, 2)->default(0)->nullable();
            $table->decimal('house_allowance', 12, 2)->default(0)->nullable();
            $table->decimal('medical_allowance', 12, 2)->default(0)->nullable();
            $table->decimal('transport_allowance', 12, 2)->default(0)->nullable();
            $table->decimal('other_allowance', 12, 2)->default(0)->nullable();
            $table->decimal('provident_fund', 12, 2)->default(0)->nullable();
            $table->decimal('tax_deduction', 12, 2)->default(0)->nullable();
            $table->decimal('other_deduction', 12, 2)->default(0)->nullable();

            $table->boolean('is_active')->nullable()->default(0);
            $table->timestamp('effective_from');
            $table->timestamp('effective_to')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['tenant_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_structures');
    }
};
