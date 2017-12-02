<?php

session_start();

use Phalcon\Mvc\Controller;
use Blog\Library\Auth\SessionManager;

class ControllerBase extends Controller
{
    public function onConstruct()
    {
        // Add some local CSS resources
        $this->assets->addCss('css/normalize.css');
        $this->assets->addCss('css/bootstrap.min.css');
        $this->assets->addCss('css/login.css');
        $this->assets->addCss('css/styles.css');


        // And some local JavaScript resources
        $this->assets->addJs('js/jquery-3.2.1.js');
        $this->assets->addJs('/js/bootstrap.min.js');
        $this->assets->addJs('/js/core.js');
    }

    /**
     * Checks if received variable is empty or not by.. custom criteria
     * @param $variable
     * @return mixed
     */
    protected function isEmpty($variable)
    {
        if (empty($variable) || $variable == 'na') {
            return true;
        }
        return false;
    }

    /**
     * Return if session is started
     * @return bool
     */

    protected function sessionStart()
    {
        $session = new SessionManager();
        if ($session->isLogged()) {
            return true;
        }

        return false;

    }

    /**
     * Return object session
     * @return SessionManager
     */

    protected function getSessionObject()
    {
        $session = new SessionManager();
        return $session;


    }

}
