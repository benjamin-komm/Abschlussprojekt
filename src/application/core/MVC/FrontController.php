<?php declare(strict_types=1);

namespace core\MVC;

use core\ProjectConfig;

class FrontController {

    private View $view;
    private ProjectConfig $config;

    public function __construct(ProjectConfig $config) {
        $this->config = $config;
        $this->view = new View();
    }

    /**
     * @return View
     */
    public function getView(): View {
        return $this->view;
    }

    /**
     * @return ProjectConfig
     */
    public function getConfig(): ProjectConfig {
        return $this->config;
    }


}