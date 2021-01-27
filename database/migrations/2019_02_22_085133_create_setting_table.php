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
            $table->string('clinic_name_kh');
            $table->string('clinic_name_en');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('navbar_color')->default('navbar-white navbar-light');
            $table->boolean('sidebar_color')->default(0);
            $table->timestamps();
        });

        
		// Insert some languages
		$setting = [
			[
				'logo' => 'logo.png',
				'clinic_name_kh' => 'ឈ្មោះគ្លីនិច',
				'clinic_name_en' => 'Clinic Name',
				'phone' => '0',
				'address' => '0',
				'navbar_color' => 'navbar-white navbar-light',
				'sidebar_color' => 0,
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
