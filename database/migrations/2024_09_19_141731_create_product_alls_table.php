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
        Schema::create('product_alls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price',total: 10, places: 2);
            $table->text('description');
            $table->foreignId('type_id');
            $table->integer('quantity');
            $table->foreignId('user_id');
            $table->foreignId('location_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_alls');
    }
};
