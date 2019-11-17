<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_lists', function (Blueprint $table) {
        $table->increments('id');
        $table->string('profile_id', 50)->nullable();
        $table->string('fav_profile_id', 50)->nullable();
        $table->string('id_address', 50)->nullable();
        $table->string('browser', 500)->nullable();
        $table->integer('added_by')->nullable();
        $table->integer('edited_by')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_lists');
    }
}
