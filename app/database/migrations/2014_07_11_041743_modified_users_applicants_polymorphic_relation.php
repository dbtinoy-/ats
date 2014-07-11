<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifiedUsersApplicantsPolymorphicRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_applicants', function(Blueprint $table)
		{
//                    $table->dropColumn('userable_id', 'userable_type');
//                    $table->integer('cv_id')->unsigned()->index();
//                    $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_applicants', function(Blueprint $table)
		{
			//
		});
	}

}
