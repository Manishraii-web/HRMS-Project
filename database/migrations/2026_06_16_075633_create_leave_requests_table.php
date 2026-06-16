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
        Schema::create('leave_requests', function (Blueprint $table) {
            Schema::create('leave_requests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
                $table->foreignId('leave_type_id')->constrained('leave_types')->restrictOnDelete();
                $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
                $table->integer('total_days')->nullable();
                $table->text('reason')->nullable();
                $table->string('status')->nullable();
                $table->text('rejection_reason')->nullable();
                $table->string('document_path')->nullable();
                $table->timestamp('approved_at')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['tenant_id', 'employee_id']);
                $table->index(['tenant_id', 'status']);
                $table->index(['tenant_id', 'start_date', 'end_date']);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
