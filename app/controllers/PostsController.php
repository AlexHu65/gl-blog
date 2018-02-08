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

    public function showAction($post_id = '')
    {
      //  $this->view->disable();
        $dataPosts = [];
        if ($post_id == '' || !(is_numeric($post_id))) {
            return $this->response->redirect('errors/notfound/');
        }

        $posts = \Blog\Models\Posts::find([
            'conditions' => 'post_id =?1',
            'bind' => [
                1 => $post_id
            ]
        ]);

        if (sizeof($posts->toArray()) <= 0) {
            return $this->response->redirect('errors/notfound/');
        }

        foreach ($posts as $post) {
            $dataPosts = [
                'id' => $post->getPostId(),
                'date' => $post->getDate(),
                'category' => $post->getCategory(),
                'user_id' => $post->getUserId(),
                'title' => $post->getTitle(),
                'status' => $post->getStatus(),
                'comments' => $this->getComments($post_id)
            ];
        }
        //Set data posts on the view

        $this->view->post = $dataPosts;

        //Start paginator-->
        $currentPage = $this->request->getQuery("c", "int");
        $data = $dataPosts['comments'];
        $paginator = new Paginator(
            [
                'data' => $data,
                'limit' => 2,
                'page' => $currentPage
            ]
        );
        return $this->view->comments = $paginator->getPaginate();
        //<--End pagination

    }

    /**
     * Show comments of each post
     * @param string $post_id
     * @return array
     */

    private function getComments($post_id = '')
    {

        $comments = \Blog\Models\Comments::find([
            "conditions" => "post_id = :postId: AND status = 1" ,
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

    public function saveCommentsAction()
    {
        $this->view->disable();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            $data = [
                'post_id' => !(isset($_POST['post_id'])) || $_POST['post_id'] == '' ? '' : $_POST['post_id'],
                'user_id' => !(isset($_POST['user_id'])) || $_POST['user_id'] == '' ? '' : $_POST['user_id'],
                'message' => !(isset($_POST['comment'])) || $_POST['comment'] == '' ? '' : $_POST['comment'],
                'DATE' => date("Y-m-d H:i:s"),
                'status' => 2
            ];

            foreach ($data as $row) {
                if (empty($row)) {
                    return print_r(false);
                }
            }
            $comments = new \Blog\Models\Comments();
            $comments->save([
                'post_id' => $data['post_id'],
                'user_id' => $data['user_id'],
                'message' => $data['message'],
                'DATE' => $data['DATE'],
                'status' => 2,
            ]);

            if ($comments === false) {
                return print_r(false);
            }
            //Returns as a plain text to do the validation in the ajax's side
            return print_r(true);

        }

        return print_r(false);

    }


}