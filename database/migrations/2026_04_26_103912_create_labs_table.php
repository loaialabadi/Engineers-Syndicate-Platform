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
        Schema::create('labs', function (Blueprint $table) {

            $table->id();

            // الاسم
            $table->string('name');

            // رابط الصفحة
            $table->string('slug')->unique();

            // التخصص
            $table->string('specialty')->nullable();

            // وصف كامل
            $table->longText('description')->nullable();

            // الهاتف
            $table->string('phone')->nullable();

            // واتساب
            $table->string('whatsapp')->nullable();

            // الصورة
            $table->string('image')->nullable();

            // العنوان
            $table->string('address')->nullable();

            // رابط الخرائط
            $table->longText('location_url')->nullable();
            // المدينة / المنطقة
            $table->string('city')->nullable();

            // مواعيد العمل
            $table->string('working_hours')->nullable();

            // نسبة الخصم
            $table->decimal('discount_percent', 5, 2)->default(0);

            // حالة الظهور
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labs');
    }
};