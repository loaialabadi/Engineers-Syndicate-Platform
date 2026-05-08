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
Schema::create('trips', function (Blueprint $table) {
    $table->id();

    $table->string('title');

    $table->text('description');
    $table->string('destination')->nullable();
    $table->date('trip_date');
    $table->date('return_date')->nullable();
    $table->string('slug')->nullable(); // أضف nullable هنا


    $table->decimal('price', 10, 2);
    $table->integer('max_seats');

    $table->string('image')->nullable();

    $table->boolean('is_active')->default(true);

    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
