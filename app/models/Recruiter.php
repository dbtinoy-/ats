<?php


class Recruiter extends Eloquent {

    protected $table = "users_recruiters";

    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
}
