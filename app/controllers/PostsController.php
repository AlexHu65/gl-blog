<?php

use Phalcon\Paginator\Adapter\NativeArray as Paginator;

class PostsController extends ControllerBase
{

    public function onConstruct()
    {
        if (!$this->sessionStart()) {
            $this->response->redirect('accounts/');
        }

        return parent::onConstruct();
    }

    public function indexAction()
    {

    }

    public function showAction($post_id = '')
    {
        if ($post_id != '') {
            $post = \Blog\Models\Posts::findFirst($post_id);
            if (!$post) {
                $this->response->redirect('');

            } else {
                $dataPosts = [
                    'id' => $post->getPostId(),
                    'date' => $post->getDate(),
                    'category' => $post->getCategory(),
                    'user_id' => $post->getUserId(),
                    'title' => $post->getTitle(),
                    'status' => $post->getStatus(),
                    'comments' => $this->showComments($post_id)

                ];

                $this->view->post = $dataPosts;


                $currentPage = $this->request->getQuery("c", "int");
                $data = $dataPosts['comments'];
                $paginator = new Paginator(
                    [
                        'data' => $data,
                        'limit' => 10,
                        'page' => $currentPage
                    ]
                );
                $this->view->comments = $paginator->getPaginate();

            }
        } else {
            $this->response->redirect('');
        }


    }

    /**
     * Show comments of each post
     * @param string $post_id
     * @return array
     */

    private function showComments($post_id = '')
    {
        $comments = \Blog\Models\Comments::find([
            "conditions" => "post_id = :postId:",
            "bind" => [
                'postId' => $post_id,
            ]
        ]);
        $dataComments = [];
        foreach ($comments as $comment) {
            $dataComments[] = [
                'id' => $comment->getCommentId(),
                'post_id' => $comment->getPostId(),
                'user_id' => $comment->getUserId(),
                'message' => $comment->getMessage(),
                'date' => $comment->getDate(),
                'status' => $comment->getStatus(),

            ];
        }
        return $dataComments;

    }


}