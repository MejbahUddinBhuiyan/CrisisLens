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
    Schema::create('shelter_statuses', function (Blueprint $table) {
        $table->id();

        $table->foreignId('shelter_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('status')->default('available');

        $table->unsignedInteger('available_capacity')->default(0);
        $table->unsignedInteger('occupied_capacity')->default(0);

        $table->text('note')->nullable();

        $table->foreignId('updated_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->timestamps();

        $table->index('status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelter_statuses');
    }
};
