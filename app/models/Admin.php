<?php

namespace Blog\Models;

use Phalcon\Mvc\Models;

class Admin extends Models
{

    protected $admin_id;


    protected $user_id;


    protected $level;


    protected $DATE;

    public function initialize()
    {
        $this->hasOne(
            'admin_id',
            'Users',
            'user_id'
        );
    }


    public function getAdminId()
    {
        return $this->admin_id;

    }

    public function getUserId()
    {

        return $this->user_id;
    }

    public function getLevel()
    {

        return $this->level;
    }


    public function getDate()
    {

        return $this->DATE;
    }


}