<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->string('full_name', 100)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('mobile_no', 100)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('cover_photo', 100)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('paid_status', 30)->nullable();
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
        Schema::dropIfExists('agent_lists');
    }
}
