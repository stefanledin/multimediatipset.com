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
			$table->integer('game_id')->unsigned()->nullable();
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
			$table->dropForeign('predictions_game_id_foreign');
			$table->dropForeign('predictions_user_id_foreign');
		});
	}

}
