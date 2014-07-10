<?php

class RecruitmentDashboardController extends RecruitmentController {

	/**
	 * Recruitment dashboard
	 *
	 */
	public function getIndex()
	{
        return View::make('recruitment/dashboard');
	}

}