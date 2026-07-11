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
    Schema::create('report_images', function (Blueprint $table) {
        $table->id();

        $table->foreignId('report_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('disk')->default('private');
        $table->string('path');
        $table->string('original_name')->nullable();
        $table->string('mime_type')->nullable();
        $table->unsignedBigInteger('size')->nullable();

        $table->boolean('is_analyzed')->default(false);
        $table->string('ai_damage_label')->nullable();
        $table->decimal('ai_confidence_score', 5, 4)->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_images');
    }
};
