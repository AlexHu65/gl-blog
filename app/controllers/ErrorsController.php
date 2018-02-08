<?php

class ErrorsController extends ControllerBase
{

    public function onConstruct()
    {

        if (!$this->sessionStart()) {
            $this->response->redirect('accounts/');
        }
        return parent::onConstruct();
    }


    public function notFoundAction()
    {


    }

}