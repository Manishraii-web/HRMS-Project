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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();

            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->integer('days_allowed')->nullable()->default(0);
            $table->boolean('is_paid')->nullable();
            $table->boolean('requires_document')->nullable();
            $table->boolean('is_active')->nullable()->default(0);
            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique(['tenant_id', 'code']);
            $table->index('tenant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
