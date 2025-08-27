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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doctor_id')->constrained()->onDelete('cascade'); // مع الربط بجدول الأطباء
            $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // الربط بالفرع

            $table->string('day'); // اسم اليوم مثل Saturday
            $table->time('start_time'); // وقت البداية
            $table->time('end_time');   // وقت النهاية
            $table->integer('session_duration'); // مدة الجلسة بالدقائق

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
