<?php

/**
 * Created by PhpStorm.
 * User: alejandro.chavez
 * Date: 11/23/2017
 * Time: 10:42 AM
 */
class CategoriesController extends ControllerBase
{

    public function indexAction()
    {

        $content = $this->selectAllCategories();
        if (isset($content['error'])) {
            $this->response->redirect('');
        }

        $this->view->categories = $content;

    }

    private function selectAllCategories()
    {
        $categories = Blog\Models\Categories::find();
        $dataCategories = [];
        if (!$categories) {
            return $dataCategories = ['error' => $this->flash->error("Couldn't find your categories. What's up?")];
        } else {
            foreach ($categories as $category) {
                $dataCategories[] = [
                    'id' => $category->getCategoryId(),
                    'name' => $category->getName()
                ];
            }
            return $dataCategories;
        }
    }


}