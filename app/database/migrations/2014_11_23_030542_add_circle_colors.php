<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCircleColors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('circles', function($table)
        {
			$table->string('ONEcolor', 255)->default("#000000");
			$table->string('TWOcolor', 255)->default("#000000");
			$table->string('THREEcolor', 255)->default("#000000");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('circles', function($table)
        {
        });
	}

}
