<?php

use Zizaco\Confide\ConfideUser;

class Admin extends ConfideUser {

    protected $table = "users_admins";

    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
}
