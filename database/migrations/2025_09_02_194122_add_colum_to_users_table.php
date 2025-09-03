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
        Schema::table('users', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->integer('gender_cd_id')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('lang')->default('ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('gender_cd_id');
            $table->dropColumn('fcm_token');
            $table->dropColumn('provider_id')->nullable();
            $table->dropColumn('provider_name')->nullable();
            $table->string('lang')->nullable();
        });
    }
};
