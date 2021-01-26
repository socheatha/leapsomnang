<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo');
            $table->string('clinic_name');
            $table->string('navbar_top_color');
            $table->string('sidebar_color');
            $table->timestamps();
        });

        
		// Insert some languages
		$setting = [
			[
				'logo' => 'logo.png',
				'clinic_name' => 'Clinic Name',
				'navbar_top_color' => 'navbar-white navbar-light',
				'sidebar_color' => 'sidebar-dark-primary',
			],
		];
        DB::table('setting')->insert($setting);
    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}
