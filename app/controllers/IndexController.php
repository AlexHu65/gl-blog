<?php

use Phalcon\Mvc\Library;
use Phalcon\Paginator\Adapter\NativeArray as Paginator;

class IndexController extends ControllerBase
{
    public function onConstruct()
    {
        if (!$this->sessionStart()) {
            $this->response->redirect('accounts');
        }

        return parent::onConstruct();
    }


    public function indexAction()
    {
        $currentPage = $this->request->getQuery("p", "int");
        $data = $this->showAllPosts();
        $paginator = new Paginator(
            [
                'data' => $data,
                'limit' => 5,
                'page' => $currentPage
            ]
        );
        $this->view->posts = $paginator->getPaginate();
    }

    /**
     * Show all posts on the index page
     * @return array
     */

    public function showAllPosts()
    {
        $posts = \Blog\Models\Posts::find();
        $dataPosts = [];
        foreach ($posts as $post) {
            $dataPosts[] = [
                'id' => $post->getPostId(),
                'date' => $post->getDate(),
                'category' => $post->getCategory(),
                'user_id' => $post->getUserId(),
                'title' => $post->getTitle(),
                'status' => $post->getStatus(),
            ];
        }
        return $dataPosts;
    }

}

