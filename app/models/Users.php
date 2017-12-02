<?php

namespace Blog\Models;

use InvalidArgumentException;
use Phalcon\Mvc\Model;

// Table Users

class Users extends Model
{

    protected $user_id;

    protected $name;

    protected $lastname;

    protected $email;

    protected $area;

    protected $categories;

    public function initialize()
    {
        $this->hasMany(
            'user_id',
            'Blog\Models\Posts',
            'post_id'
        );

     /*   $this->hasMany(
            'user_id',
            'Messages',
            'message_id'
        );

        $this->hasOne(
            'user_id',
            'Admin',
            'admin_id'
        );*/
    }

    public function setUserId($userid)
    {
        if ($userid < 0) {
            throw new InvalidArgumentException(
                'Invalid user id'
            );
        }

        $this->user_id = $userid;

    }

    public function getUserId()
    {
        return $this->user_id;
    }


    public function setName($name)
    {
        if (strlen($name) < 2) {

            throw new InvalidArgumentException(
                'Name too short'
            );

        }
        $this->name = strtoupper($name);
    }

    public function getUserName()
    {
        return $this->name;
    }


    public function getUserLastName()
    {
        return $this->lastname;
    }

    public function getEmail()
    {

        return $this->email;
    }


    public function getArea()
    {

        return $this->area;
    }

    public function getCategories()
    {

        return $this->area;
    }

}