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

    $table->string('name');
    $table->string('email');
    $table->string('phone');

    $table->date('booking_date');
    $table->time('start_time');
    $table->time('end_time');

    $table->string('purpose')->nullable();

    $table->string('booking_reference')->unique();

    $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

    $table->text('admin_notes')->nullable();

    $table->timestamps();

    // تحسين الأداء
    $table->index(['booking_date', 'start_time', 'end_time']);
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
