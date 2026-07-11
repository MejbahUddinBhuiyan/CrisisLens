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
    Schema::create('shelters', function (Blueprint $table) {
        $table->id();

        $table->foreignId('location_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('name');
        $table->text('address');

        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);

        $table->unsignedInteger('capacity')->default(0);
        $table->unsignedInteger('current_occupancy')->default(0);

        $table->string('contact_phone')->nullable();
        $table->string('contact_email')->nullable();

        $table->json('facilities')->nullable();

        $table->boolean('is_active')->default(true);
        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['latitude', 'longitude']);
        $table->index('is_active');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
