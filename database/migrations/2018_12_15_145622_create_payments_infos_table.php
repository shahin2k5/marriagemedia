<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->string('client_type', 50);
            $table->integer('package_id')->unsigned();
            $table->string('payment_method', 60);
            $table->string('mobile_no', 60)->nullable();
            $table->integer('trans_id')->nullable();
            $table->decimal('amount');
            $table->integer('added_by')->unsigned();
            $table->integer('verified_by')->nullable();
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
        Schema::dropIfExists('payments_infos');
    }
}
