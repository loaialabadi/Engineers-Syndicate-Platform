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
        Schema::create('doctors', function (Blueprint $table) {

            $table->id();

            // البيانات الأساسية
            $table->string('name');
            $table->string('slug')->unique();

            // معلومات الدكتور
            $table->string('specialty')->nullable();
            $table->text('description')->nullable();

            // التواصل
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();

            // الصورة
            $table->string('image')->nullable();

            // العنوان
            $table->string('address')->nullable();
            $table->string('city')->nullable();

            // رابط الخريطة
$table->longText('location_url')->nullable();
            // مواعيد العمل
            $table->string('working_hours')->nullable();

            // نسبة الخصم
            $table->decimal('discount_percent', 5, 2)->default(0);

            // الحالة
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};