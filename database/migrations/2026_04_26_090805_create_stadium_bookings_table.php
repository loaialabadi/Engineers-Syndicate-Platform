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
Schema::create('stadium_bookings', function (Blueprint $table) {
    $table->id();

    $table->string('booking_reference')->unique();

    $table->string('name');
    $table->string('phone');
    $table->boolean('is_engineer')->default(false);

    $table->date('booking_date');
    $table->time('start_time');
    $table->time('end_time');

    $table->unsignedInteger('total_hours')->nullable();

    $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

    $table->text('purpose')->nullable();
    $table->text('admin_notes')->nullable();

    $table->softDeletes();
    $table->timestamps();

    $table->index(['booking_date', 'status']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadium_bookings');
    }
};
