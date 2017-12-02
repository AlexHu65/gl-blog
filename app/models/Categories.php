<?php

namespace Blog\Models;
use Phalcon\Mvc\Model;

class Categories extends Model
{

    protected $category_id;


    protected $name;


    public function initialize()
    {
        $this->hasOne(
            'category_id',
            'Posts',
            'post_id'
        );
    }


    public function getCategoryId()
    {

        return $this->category_id;
    }


    public function getName()
    {

        return $this->name;
    }


}