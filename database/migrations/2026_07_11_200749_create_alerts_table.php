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
    Schema::create('alerts', function (Blueprint $table) {
        $table->id();

        $table->foreignId('disaster_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('location_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('published_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->string('title');
        $table->text('message');

        $table->string('risk_level')->default('Advisory');
        $table->string('status')->default('draft');

        $table->boolean('requires_human_approval')->default(true);
        $table->boolean('is_approved')->default(false);

        $table->foreignId('approved_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->timestamp('approved_at')->nullable();
        $table->timestamp('published_at')->nullable();
        $table->timestamp('expires_at')->nullable();

        $table->boolean('is_demo')->default(true);

        $table->timestamps();

        $table->index(['risk_level', 'status']);
        $table->index(['published_at', 'expires_at']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
