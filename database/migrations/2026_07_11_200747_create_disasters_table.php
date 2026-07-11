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
    Schema::create('disasters', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('type');
        $table->string('risk_level')->default('Safe');

        $table->text('description')->nullable();

        $table->timestamp('started_at')->nullable();
        $table->timestamp('ended_at')->nullable();

        $table->string('status')->default('monitoring');
        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['type', 'risk_level']);
        $table->index('status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disasters');
    }
};
