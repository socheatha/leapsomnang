<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prescription_details', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('qty');
          $table->boolean('morning')->default('0');
          $table->boolean('noon')->default('0');
          $table->boolean('evening')->default('0');
          $table->boolean('night')->default('0');
          $table->text('description');
          $table->integer('index');
          $table->unsignedBigInteger('medicine_id');
          $table->unsignedBigInteger('prescription_id');
          $table->unsignedBigInteger('created_by');
          $table->unsignedBigInteger('updated_by');
          $table->timestamps();

          $table->foreign('medicine_id')
              ->references('id')->on('medicines')
              ->onDelete('no action')
              ->onUpdate('no action');

          $table->foreign('prescription_id')
              ->references('id')->on('prescriptions')
              ->onDelete('no action')
              ->onUpdate('no action');

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
        Schema::dropIfExists('prescription_details');
    }
}
