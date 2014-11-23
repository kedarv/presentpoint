<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCircles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('circles', function($table)
        {
           $table->dropColumn('ONEcolor');
           $table->dropColumn('TWOcolor');
           $table->dropColumn('THREcolor');
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
