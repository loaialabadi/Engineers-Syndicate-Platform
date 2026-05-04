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
        Schema::create('trip_bookings', function (Blueprint $table) {
            $table->id();

            // الربط مع جدول الرحلات
            $table->foreignId('trip_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name'); // اسم الحاجز
            $table->string('phone'); // رقم الهاتف
            
            // رقم العضوية (nullable) لأنه قد يكون المرافق غير مهندس
            $table->string('membership_number');
            $table->string('national_id'); 
            
            // عدد المقاعد المطلوبة في الحجز الواحد
            $table->integer('seats')->default(1);

            // حالة الحجز (قيد الانتظار، مقبول، مرفوض)
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
 $table->unique(['trip_id', 'national_id'], 'unique_trip_user');
            // ملاحظات الإدارة (مثل سبب الرفض)
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_bookings');
    }
};
