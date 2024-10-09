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
        //
        Schema::table('product_alls', function (Blueprint $table) {
            $table->enum('status',['pending','approved','declined'])->default('pending');
        });
        Schema::table('product_equipments', function (Blueprint $table) {
            $table->enum('status',['pending','approved','declined'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
