<?php

use Zizaco\Confide\ConfideUser;

class Recruiter extends ConfideUser {

    protected $table = "users_recruiters";

    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
}
