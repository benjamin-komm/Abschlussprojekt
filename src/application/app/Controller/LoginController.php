<?php declare(strict_types=1);

namespace app\Controller;

use app\Models\UserModel;
use core\MVC\FrontController;

class LoginController extends FrontController {

    public function indexAction() {
        $user = $_GET['user'] ?? null;
        $password = $_GET['password'] ?? null;
        $userModel = new UserModel($this->getConfig());
        $loginResponse = false;

        if (array_key_exists('user', $_SESSION)) {
            $loginResponse = 'alreadyLoggedIn';
        } else {
            if ($user !== null && $password !== null && $userModel->getUser($user, $password) !== null) {
                $_SESSION['user'] = $user;
                if (strtolower($user) == 'admin') {
                    $_SESSION['isAdmin'] = true;
                }
                $loginResponse = 'done';
            } else if ($user !== null && $password !== null) {
                $loginResponse = 'error';
            }
        }

        $this->getView()->assign('loginResponse', $loginResponse);
        $this->getView()->addView('LoginView.phtml');
        return $this->getView()->render();
    }


    public function logoutAction() {
        if (array_key_exists('user', $_SESSION)) {
            unset($_SESSION['user']);
        }
        header('Location: /', true, 302);

    }

}