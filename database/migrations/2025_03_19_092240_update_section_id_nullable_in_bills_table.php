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
        Schema::table('bills', function (Blueprint $table) {
            // ✅ اجعل section_id يقبل NULL
            $table->bigInteger('section_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            // ❌ استرجاع التعديل وجعله NOT NULL (إذا احتجت الرجوع)
            $table->bigInteger('section_id')->unsigned()->nullable(false)->change();
        });
    }
};
