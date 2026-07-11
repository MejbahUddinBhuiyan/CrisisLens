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
    Schema::create('emergency_documents', function (Blueprint $table) {
        $table->id();

        $table->foreignId('uploaded_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->string('title');
        $table->string('language')->default('en');
        $table->string('category')->nullable();

        $table->string('disk')->default('private');
        $table->string('path')->nullable();

        $table->longText('content')->nullable();

        $table->boolean('is_verified')->default(false);
        $table->boolean('is_active')->default(true);
        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['language', 'category']);
        $table->index(['is_verified', 'is_active']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_documents');
    }
};
