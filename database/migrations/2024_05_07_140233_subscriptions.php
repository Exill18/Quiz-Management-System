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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->string('plan_name');
            $table->decimal('plan_price', 8, 2);
            $table->text('plan_description')->nullable();
            $table->integer('credits_per_month')->default(0); // Add this line
            $table->integer('duration_days')->default(30); // Duration of the subscription in days
            $table->dateTime('start_date')->useCurrent();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
