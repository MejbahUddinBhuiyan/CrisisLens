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
    Schema::create('alert_preferences', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->boolean('receive_safe_updates')->default(false);
        $table->boolean('receive_advisory_alerts')->default(true);
        $table->boolean('receive_warning_alerts')->default(true);
        $table->boolean('receive_critical_alerts')->default(true);

        $table->boolean('email_enabled')->default(true);
        $table->boolean('web_enabled')->default(true);
        $table->boolean('sms_enabled')->default(false);

        $table->string('phone_number')->nullable();

        $table->json('disaster_types')->nullable();

        $table->timestamps();

        $table->unique('user_id');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_preferences');
    }
};
