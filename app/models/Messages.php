<?php

namespace Blog\Models;

use Phalcon\Mvc\Models;


class Messages extends Models
{

    protected $message_id;

    protected $post_id;

    protected $content;

    public function initialize()
    {
        $this->belongsTo(
            'message_id',
            'Posts',
            'post_id'
        );

    }

    public function getMessageId()
    {

        return $this->message_id;
    }

    public function getPostId()
    {

        return $this->post_id;
    }

    public function getContent()
    {

        return $this->content;

    }


}