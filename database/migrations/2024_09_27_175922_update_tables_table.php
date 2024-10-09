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
        
        Schema::rename('categorys', 'categories');
        Schema::rename('sub_categorys', 'subcategories');
        Schema::rename('shop_addresses', 'shop_adds');
        Schema::rename('product_alls', 'products');
        Schema::rename('product_equipments', 'equipments');
        Schema::drop('product_types');

        Schema::table('subcategories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
           });

        Schema::table('products', function (Blueprint $table) {
        $table->renameColumn('type_id', 'subcat_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('subcat_id')->references('id')->on('subcategories');
        $table->foreign('location_id')->references('id')->on('lgas');
        });
        Schema::table('equipments', function (Blueprint $table) {
         $table->renameColumn('type_id', 'subcat_id');
         $table->foreign('user_id')->references('id')->on('users');
         $table->foreign('location_id')->references('id')->on('lgas');
         $table->foreign('subcat_id')->references('id')->on('subcategories');
        });

        Schema::table('bulk_sizes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
           });
           Schema::table('equipment_images', function (Blueprint $table) {
            $table->renameColumn('product_equipment_id', 'equipment_id');
            $table->foreign('equipment_id')->references('id')->on('equipments');
           });
           Schema::table('lgas', function (Blueprint $table) {
            $table->foreign('state_id')->references('id')->on('states');
           });
           Schema::table('product_images', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
           });
           Schema::table('shops', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
           });
           Schema::table('shop_adds', function (Blueprint $table) {
            $table->foreign('shop_id')->references('id')->on('shops');
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
