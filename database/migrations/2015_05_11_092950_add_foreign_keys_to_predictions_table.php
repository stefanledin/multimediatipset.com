<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPredictionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('predictions', function (Blueprint $table)
		{
			#$table->integer('user_id')->unsigned();
			#$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('predictions', function (Blueprint $table)
		{
			#$table->dropColumn('user_id');
			$table->dropColumn('game_id');
		});
	}

}
