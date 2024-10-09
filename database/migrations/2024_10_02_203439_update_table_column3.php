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
        Schema::table('shop_adds', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('lgas');
            });

            Schema::create('feedbacks', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('ad_type'); 
                $table->unsignedBigInteger('ad_id');
                $table->integer('rating')->nullable(); 
                $table->text('comments'); 
                $table->timestamps(); 
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
