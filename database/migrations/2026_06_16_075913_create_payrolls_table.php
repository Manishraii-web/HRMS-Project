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
        Schema::create('payrolls', function (Blueprint $table) {
            Schema::create('payrolls', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
                $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
                $table->integer('month')->nullable();
                $table->integer('year')->nullable();
                $table->string('period_label')->nullable();
                $table->decimal('basic_salary', 12, 2)->nullable()->default(0);
                $table->decimal('house_allowance', 12, 2)->nullable()->default(0);
                $table->decimal('transport_allowance', 12, 2)->nullable()->default(0);
                $table->decimal('medical_allowance', 12, 2)->nullable()->default(0);
                $table->decimal('other_allowance', 12, 2)->nullable()->default(0);
                $table->decimal('gross_salary', 12, 2)->nullable()->default(0);
                // Deductions
                $table->decimal('provident_fund', 12, 2)->nullable()->default(0);
                $table->decimal('tax_deduction', 12, 2)->nullable()->default(0);
                $table->decimal('other_deduction', 12, 2)->nullable()->default(0);
                $table->decimal('total_deductions', 12, 2)->nullable()->default(0);
                // Net
                $table->decimal('net_salary', 12, 2)->nullable()->default(0);
                // Attendance context
                $table->integer('working_days')->nullable();
                $table->integer('present_days')->nullable();
                $table->integer('absent_days')->nullable();
                $table->integer('leave_days')->nullable();
                $table->string('status')->nullable();
                $table->timestamp('paid_at')->nullable();
                $table->text('notes')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->unique(['tenant_id', 'employee_id', 'month', 'year']);
                $table->index(['tenant_id', 'month', 'year']);
                $table->index(['tenant_id', 'status']);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
