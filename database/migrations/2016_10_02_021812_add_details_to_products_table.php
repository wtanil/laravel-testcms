<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            
            $table->integer('user_id')->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('category_id')->unsigned()->after('user_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('product_name', 255)->after('category_id');
            $table->string('product_description', 1000)->after('product_name');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            
            $table->dropForeign(['user_id', 'category_id']);
            $table->dropColumn(['user_id', 'category_id', 'product_name', 'product_description']);


        });
    }
}
