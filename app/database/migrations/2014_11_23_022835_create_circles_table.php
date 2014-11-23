<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCirclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('circles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('rid');
			$table->string('ONEcolor', 255)->nullable();
			$table->string('TWOcolor', 255)->nullable();
			$table->string('THREcolor', 255)->nullable();
			$table->integer('ONEvotes');
			$table->integer('TWOvotes');
			$table->integer('THREEvotes');
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
		Schema::drop('circles');
	}

}
