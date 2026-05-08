<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // اسم الخدمة
            $table->string('category')->nullable(); // التصنيف (نص بسيط)
            $table->text('description')->nullable(); // وصف مختصر
            $table->longText('content')->nullable(); // شرح كامل

            $table->string('image')->nullable(); // صورة الخدمة

            $table->boolean('has_whatsapp')->default(false);
            $table->string('whatsapp_number')->nullable();
            $table->text('whatsapp_message')->nullable();

            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};