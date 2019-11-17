<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mobile_no', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->integer('added_by');
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
        Schema::dropIfExists('company_infos');
    }
}
