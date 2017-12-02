<?php

use Blog\Models\Users;


class AccountsController extends ControllerBase
{
    /**
     * Index controller  - PATH/acounts/
     * @return void
     */

    public function indexAction()
    {
        //Accounts
        if ($this->sessionStart()) {
            $this->response->redirect('');
        }
    }

    /**
     * Login Action  - PATH/acounts/login/
     * @return void
     */

    public function loginAction()
    {
        //Login
        if (!$this->sessionStart()) {
            $this->response->redirect('accounts/');
        }

        $mail = ($this->isEmpty($_POST['email'])) ? false : $_POST['email'];
        $auth = ($this->isEmpty($_POST['auth'])) ? false : $_POST['auth'];

        if ($mail && $auth) {
            $this->loginAttempt($mail, $auth);
        }

        if (isset($_SESSION['user'])) {
            $this->response->redirect('');
        }

    }

    /**
     * Action to destroy all sessions
     * @return void
     */

    public function signOutAction()
    {
        if ($this->destroySession()) {
            $this->response->redirect('accounts/');
        }

    }

    /**
     * Attempts to start session
     * @param $mail
     * @param $auth
     * @return array
     */

    private function loginAttempt($mail, $auth)
    {
        //Conditions
        $conditions = 'email = :mail: AND  pass_test = :auth:';

        //Bind data
        $bind = [
            'mail' => $mail,
            'auth' => $auth
        ];

        //Execute query for users
        $users = Users::findFirst(array(
            $conditions,
            'bind' => $bind
        ));

        if ($users) {
            $userData = [
                'id' => $users->getUserId(),
                'name' => $users->getUserName(),
                'lastname' => $users->getUserLastName(),
                'email' => $users->getEmail(),
                'area' => $users->getArea(),
                'categories' => $users->getCategories(),
                'logged' => true
            ];
            return $this->saveDataSession($userData);
        } else {
            //User not found
            $this->response->redirect('accounts');
        }

    }

    /**
     * Save data of the user on $_SESSION
     * @param array $userData
     * @return array
     */
    private function saveDataSession($userData = [])
    {
        //Session user
        if (sizeof($userData > 0)) {
            $_SESSION['user'] = $userData;
        }
        return $_SESSION['user'];
    }

    /**
     * Destroy user session
     * @return bool
     */

    private function destroySession()
    {
        $session = $this->getSessionObject();
        return $session->destroySession();

    }


}