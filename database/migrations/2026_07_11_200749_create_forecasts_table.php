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
    Schema::create('forecasts', function (Blueprint $table) {
        $table->id();

        $table->foreignId('location_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('disaster_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('forecast_type');
        $table->string('risk_level')->default('Safe');

        $table->decimal('confidence_score', 5, 4)->nullable();

        $table->timestamp('forecast_for');
        $table->timestamp('data_timestamp')->nullable();

        $table->string('input_data_source')->nullable();
        $table->string('model_version')->nullable();

        $table->json('input_payload')->nullable();
        $table->json('raw_response')->nullable();

        $table->string('human_review_status')->default('pending');

        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['forecast_type', 'risk_level']);
        $table->index('forecast_for');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecasts');
    }
};
