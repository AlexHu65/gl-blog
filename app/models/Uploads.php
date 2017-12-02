<?php

namespace Blog\Models;

use Phalcon\Mvc\Models;


class Uploads extends Models
{

    protected $upload_id;

    protected $post_id;

    protected $url;

    protected $extension;

    protected $downloaded;

    public function initialize()
    {
        $this->hasOne(
            'upload_id',
            'Posts',
            'post_id'
        );
    }


    public function getCommentId()
    {

        return $this->comment_id;
    }


    public function getPostId()
    {

        return $this->post_id;
    }

    public function getUserId()
    {

        return $this->user_id;

    }

    public function getMessage()
    {

        return $this->message;
    }

    public function getDate()
    {

        return $this->DATE;
    }


}