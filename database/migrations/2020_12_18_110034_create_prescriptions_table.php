<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prescriptions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->date('date');
          $table->integer('code');
          $table->integer('rate')->default('4000');
          $table->string('pt_no');
          $table->string('pt_name');
          $table->string('pt_age');
          $table->string('pt_gender')->nullable();
          $table->string('phone')->nullable();
          $table->tinyInteger('status')->default('0');
          $table->integer('remark')->nullable();
          $table->unsignedBigInteger('patient_id')->nullable();
          $table->unsignedBigInteger('created_by');
          $table->unsignedBigInteger('updated_by');
          $table->timestamps();

          $table->foreign('patient_id')
              ->references('id')->on('patients')
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
        Schema::dropIfExists('prescriptions');
    }
}
