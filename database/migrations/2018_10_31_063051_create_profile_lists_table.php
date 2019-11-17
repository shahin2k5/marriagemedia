<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('full_name', 100)->nullable();
            $table->string('sex', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('height', 50)->nullable();
            $table->integer('height_numeric');
            $table->string('weight', 50)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('marital_status', 60)->nullable();
            $table->string('education', 100)->nullable();
            $table->string('body_type', 60)->nullable();
            $table->string('drink', 50)->nullable();
            $table->string('smoke', 50)->nullable();
            $table->string('diet', 60)->nullable();
            $table->string('blood_group', 50)->nullable();
            $table->string('complexion', 50)->nullable();
            $table->string('beard', 30)->nullable();
            $table->string('mustache', 30)->nullable();
            $table->string('appearance', 100)->nullable();
            $table->string('mother_tongue', 50)->nullable();
            $table->string('age', 50)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->decimal('annual_income', 15,2)->nullable();
            $table->string('fathers_name', 100)->nullable();
            $table->string('fathers_occupation', 100)->nullable();
            $table->string('mothers_name', 100)->nullable();
            $table->string('mothers_occupation', 100)->nullable();
            $table->string('siblings', 100)->nullable();
            $table->string('family_values', 100)->nullable();
            $table->string('photo', 100)->nullable();
            $table->string('mobile_no', 60)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('permanent_address', 200)->nullable();
            $table->string('city', 60)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('publish_status', 50)->default("Unpublished");
            $table->string('profile_status', 50)->nullable();
            $table->string('paid_status', 50)->nullable();
            $table->string('complete_status', 50)->nullable();
            $table->string('added_by', 100)->nullable();
            $table->integer('agent_id')->unsigned();
            $table->integer('edited_by')->unsigned();
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
        Schema::dropIfExists('profile_lists');
    }
}
