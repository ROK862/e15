<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            # Create a relationship between items and users where each item needs to have an associated user.
            # Items act as listings, thus it makes sense to connect to two together.
            $table->bigInteger('user_id')->unsigned();
    
            # This field `user_id` is a foreign key that connects to the `id` field in the `users` table
            $table->foreign('user_id')->references('id')->on('users');
    
        });

        Schema::table('orders', function (Blueprint $table) {

            # Create a relationship between items and owner where each item needs to have an associated user.
            # Items act as listings, thus it makes sense to connect to two together.
            $table->bigInteger('owner_id')->unsigned();
    
            # This field `user_id` is a foreign key that connects to the `id` field in the `users` table
            $table->foreign('owner_id')->references('id')->on('users');
    
        });

        Schema::table('orders', function (Blueprint $table) {

            # Create a relationship between items and users where each item needs to have an associated user.
            # Items act as listings, thus it makes sense to connect to two together.
            $table->bigInteger('item_id')->unsigned();
    
            # This field `user_id` is a foreign key that connects to the `id` field in the `users` table
            $table->foreign('item_id')->references('id')->on('items');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
    
            $table->dropColumn('user_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_item_id_foreign');
    
            $table->dropColumn('item_id');
        });
    }
};