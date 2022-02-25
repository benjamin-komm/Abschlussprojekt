<?php declare(strict_types=1);

namespace app\Controller;

use core\MVC\FrontController;

class ProjectsController extends FrontController {

    public function indexAction() {
        $this->getView()->addView('ProjectsView.phtml');
        return $this->getView()->render();
    }

}