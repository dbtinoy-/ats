<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvRelationshipWithUsersApplicant extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cvs', function(Blueprint $table)
		{
                    $table->integer('applicant_id')->unsigned()->index();
                    $table->foreign('applicant_id')->references('id')->on('users_applicants')->onDelete('cascade');
		});
		Schema::table('users_applicants', function(Blueprint $table)
		{
                    $table->dropColumn('cv_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cvs', function(Blueprint $table)
		{
			//
		});
	}

}
