<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile_id', 30)->nullable();
            $table->string('client_id', 30)->nullable();
            $table->integer('from_age')->nullable();
            $table->integer('to_age')->nullable();
            $table->string('from_height', 50)->nullable();
            $table->integer('from_height_numeric')->nullable();
            $table->string('to_height', 50)->nullable();
            $table->integer('to_height_numeric')->nullable();
            $table->string('religion', 60)->nullable();
            $table->string('marital_status', 60)->nullable();
            $table->string('beard', 50)->nullable();
            $table->string('mustache', 50)->nullable();
            $table->string('appearance', 100)->nullable();
            $table->string('education', 100)->nullable();
            $table->string('body_type', 60)->nullable();
            $table->string('drink', 50)->nullable();
            $table->string('smoke', 50)->nullable();
            $table->string('diet', 50)->nullable();
            $table->string('complexion', 60)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->decimal('from_annual_income', 15,2)->nullable();
            $table->decimal('to_annual_income', 15,2)->nullable();
            $table->string('country', 60)->nullable();
            $table->string('city', 60)->nullable();
            $table->integer('added_by')->unsigned();
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
        Schema::dropIfExists('preferences');
    }
}
