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
            $table->string('mobile')->nullable()->after('email');
            $table->string('id_number')->nullable()->after('mobile');
            $table->date('date_birth')->nullable()->after('id_number');
            $table->string('photo')->nullable()->after('date_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
   $table->dropColumn('mobile');
            $table->dropColumn('id_number');
            $table->dropColumn('birth_date');
            $table->dropColumn('photo');

        });
    }
};
