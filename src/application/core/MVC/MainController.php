<?php

namespace core\MVC;

use core\ProjectConfig;
use core\Router;

class MainController {

    private ProjectConfig $config;
    private Router $router;
    private FrontController $controller;

    public function start() {
        $this->initialize();

        //TODO run Controller action
        $this->controller->{$this->getRouter()->getAction()}();

        $this->run();
    }

    /*
     * initialize the right controller
     */
    public function initialize() {
        try {
            $controllerName = $this->getRouter()->getControllerName();
            $this->controller = new $controllerName($this->getConfig());
        } catch (\Throwable $exception) {
            dd("Error while initialize the Controller");
        }
    }

    /*
     * output the final html content
     */
    public function run() {
        echo $this->controller->getView()->getContent();
    }

    /**
     * @return ProjectConfig
     */
    public function getConfig(): ProjectConfig {
        return $this->config;
    }

    /**
     * @param ProjectConfig $config
     */
    public function setConfig(ProjectConfig $config): void {
        $this->config = $config;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router {
        return $this->router;
    }

    /**
     * @param Router $router
     */
    public function setRouter(Router $router): void {
        $this->router = $router;
    }

}