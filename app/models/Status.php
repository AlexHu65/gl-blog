<?php

namespace Blog\Models;

use Phalcon\Mvc\Models;


class Status extends Models
{

    protected $status_id;

    protected $VALUE;


    public function initialize()
    {
        $this->hasOne(
            'status_id',
            'Posts',
            'post_id'
        );
    }


    public function getStatusId()
    {

        return $this->status_id;
    }


    public function getValue()
    {

        return $this->VALUE;
    }


}