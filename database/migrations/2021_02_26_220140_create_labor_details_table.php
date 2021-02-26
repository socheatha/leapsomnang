<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('labor_details', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->double('amount');
          $table->text('description');
          $table->integer('index');
          $table->double('discount')->default('0');
          $table->unsignedBigInteger('labor_id');
          $table->unsignedBigInteger('service_id');
          $table->unsignedBigInteger('created_by');
          $table->unsignedBigInteger('updated_by');
          $table->timestamps();

          $table->foreign('labor_id')
              ->references('id')->on('labors')
              ->onDelete('cascade')
              ->onUpdate('cascade');

          $table->foreign('service_id')
              ->references('id')->on('services')
              ->onDelete('cascade')
              ->onUpdate('cascade');

          $table->foreign('created_by')
              ->references('id')->on('users')
              ->onDelete('no action')
              ->onUpdate('no action');

          $table->foreign('updated_by')
              ->references('id')->on('users')
              ->onDelete('no action')
              ->onUpdate('no action');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labor_details');
    }
}
