<?php

namespace Blog\Library\Auth;

class SessionManager
{
    public function isLogged()
    {
        if (isset($_SESSION['user']['logged']) && ($_SESSION['user']['logged'])) {
            return true;
        }
        return false;
    }

    public function destroySession()
    {
        session_unset();
        session_destroy();
        return true;

    }


}