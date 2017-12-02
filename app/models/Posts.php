<?php

namespace Blog\Models;

use Phalcon\Mvc\Model;


class Posts extends Model
{

    protected $post_id;

    protected $user_id;

    protected $DATE;

    protected $category;

    protected $title;

    protected $status;

    public function initialize()
    {
        $this->belongsTo(
            'post_id',
            'Blog\Models\Users',
            'user_id'
        );

      /*  $this->hasOne(
            'post_id',
            'Uploads',
            'upload_id'
        );

        $this->hasOne(
            'post_id',
            'Status',
            'status_id'
        );

        $this->hasMany(
            'post_id',
            'Messages',
            'message_id'
        );

        $this->hasMany(
            'post_id',
            'Comments',
            'comment_id'
        );

        $this->hasOne(
            'post_id',
            'Category',
            'category_id'
        );*/

    }

    public function getPostId()
    {

        return $this->post_id;
    }


    public function getDate()
    {

        return $this->DATE;
    }

    public function getUserId()
    {

        return $this->user_id;

    }

    public function getTitle()
    {

        return $this->title;

    }

    public function getStatus()
    {

        return $this->status;

    }

    public function getCategory()
    {

        return $this->category;

    }


}