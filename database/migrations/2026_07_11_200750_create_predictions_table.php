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
    Schema::create('predictions', function (Blueprint $table) {
        $table->id();

        $table->nullableMorphs('predictable');

        $table->string('prediction_type');
        $table->string('prediction');

        $table->decimal('confidence_score', 5, 4)->nullable();

        $table->string('model_version');
        $table->timestamp('processing_timestamp');

        $table->string('input_data_source')->nullable();

        $table->json('input_payload')->nullable();
        $table->json('raw_response')->nullable();

        $table->string('human_review_status')->default('pending');

        $table->foreignId('reviewed_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->timestamp('reviewed_at')->nullable();
        $table->text('review_note')->nullable();

        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['prediction_type', 'prediction']);
        $table->index('human_review_status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
