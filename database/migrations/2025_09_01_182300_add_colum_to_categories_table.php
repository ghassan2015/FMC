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
        Schema::table('categories', function (Blueprint $table) {
            $table->longText('reason')->nullable();
            $table->longText('disease_type')->nullable();
            $table->longText('surgery_therapy')->nullable(); //العلاج بالجراحة
            $table->longText('surgery_type')->nullable(); //انواع بالجراحة
            $table->longText('preparing_operation')->nullable(); //انواع بالجراحة
            $table->longText('payment_type')->nullable(); //انواع بالجراحة
            $table->string('operation_pirce')->nullable(); //انواع بالجراحة


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('reason');

            $table->dropColumn('disease_type');
            $table->dropColumn('surgery_therapy');
            $table->dropColumn('surgery_type');
            $table->dropColumn('preparing_operation');
            $table->dropColumn('payment_type');
            $table->dropColumn('operation_pirce');
        });
    }
};
