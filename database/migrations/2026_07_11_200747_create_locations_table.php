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
    Schema::create('locations', function (Blueprint $table) {
        $table->id();

        $table->string('name')->nullable();
        $table->string('division')->nullable();
        $table->string('district')->nullable();
        $table->string('upazila')->nullable();
        $table->string('address')->nullable();

        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);

        $table->timestamps();

        $table->index(['latitude', 'longitude']);
        $table->index(['division', 'district']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
