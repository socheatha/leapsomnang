<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchoDefaultDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('echo_default_descriptions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name', 255);
          $table->string('slug', 255)->unique();
          $table->text('description');
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
        Schema::dropIfExists('echo_default_descriptions');
    }
}
