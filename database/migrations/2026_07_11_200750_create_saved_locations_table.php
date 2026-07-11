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
    Schema::create('saved_locations', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('location_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('label')->default('Saved Location');
        $table->string('address')->nullable();

        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);

        $table->boolean('is_primary')->default(false);

        $table->timestamps();

        $table->index(['user_id', 'is_primary']);
        $table->index(['latitude', 'longitude']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_locations');
    }
};
