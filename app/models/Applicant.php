<?php


class Applicant extends Eloquent {

    protected $table = "users_applicants";

    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
    /**
    * Get the post's comments.
    *
    * @return array
    */
    public function cv() {
        return $this->hasOne('Cv');
    }
}