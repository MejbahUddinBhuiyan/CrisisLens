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
    Schema::create('reports', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('disaster_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('location_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('category');
        $table->string('urgency')->default('medium');
        $table->string('status')->default('pending');

        $table->text('description');

        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);

        $table->boolean('is_verified')->default(false);

        $table->foreignId('validated_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->timestamp('validated_at')->nullable();
        $table->text('validation_note')->nullable();

        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['category', 'urgency']);
        $table->index(['status', 'is_verified']);
        $table->index(['latitude', 'longitude']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
