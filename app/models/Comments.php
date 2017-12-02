<?php

namespace Blog\Models;
use Phalcon\Mvc\Model;


class Comments extends Model
{

    protected $comment_id;

    protected $post_id;

    protected $user_id;

    protected $message;

    protected $DATE;

    protected $status;

    public function initialize()
    {
        $this->belongsTo(
            'message_id',
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

    public function getStatus()
    {

        return $this->status;
    }


}