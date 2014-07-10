<?php

use Zizaco\Confide\ConfideUser;

class Applicant extends ConfideUser {

    protected $table = "users_applicants";

    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
}