<?php declare(strict_types = 1);

namespace app\Controller;

use core\MVC\FrontController;

class HomepageController extends FrontController {

    public function indexAction() {


        $this->getView()->addView('HomepageView.phtml');
        return $this->getView()->render();
    }

}