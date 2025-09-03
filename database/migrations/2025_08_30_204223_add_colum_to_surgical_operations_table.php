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
        Schema::table('surgical_operations', function (Blueprint $table) {
            $table->integer('branch_id');
            $table->integer('doctor_id');
            $table->integer('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surgical_operations', function (Blueprint $table) {
            $table->dropColumn('branch_id');
            $table->dropColumn('doctor_id');
                        $table->dropColumn('status');

        });
    }
};
