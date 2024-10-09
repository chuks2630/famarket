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
        Schema::table('equipments', function (Blueprint $table) {
            $table->dropColumn('condition');
            $table->dropColumn('biz_type');
            $table->enum('condition', [1,2,3])->comment('1=Brand New, 2=Used, 3=for parts/not working');
            $table->enum('businesstype', [1,2,3])->comment('1=Sale, 2=Rent, 3=Lease');
            $table->integer('quantity');
            
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
