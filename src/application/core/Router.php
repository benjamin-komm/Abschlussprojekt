<?php declare(strict_types=1);

namespace core;

class Router {

    private array $map;
    private ?array $url = null;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * Find the right controller name for right page
     * @return mixed|null
     */
    public function getControllerName()
    {
        if ($this->url == null) {
            $this->parseURL();
        }

        //        $requestURLPath = strtolower($this->url['path']);
        //        $requestURLPath = explode('/', $requestURLPath)[1];
        //        d($requestURLPath);
        //        $requestURLPath = empty($requestURLPath) ? '/' : '/' . $requestURLPath . '/';
        //        d($requestURLPath);

        $controllerName = $this->map[$this->url['path']] ?? null;
        if (is_array($controllerName)) {
            $controllerName = $controllerName['controller'] ?? null;
        }
        return $controllerName;
    }

    /**
     * parse all URL components
     * @return void
     */
    public function parseURL()
    {
        $this->url = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

        $lastCharOfPath = $this->url['path'][strlen($this->url['path']) - 1];
        if ($lastCharOfPath !== '/') {
            $this->url['path'] .= '/';
        }
        $this->url['path'] = strtolower($this->url['path']);
    }

    /**
     * Find the name of the current page
     * @return string
     */
    public function getActivePage(): string
    {
        if ($this->url == null) {
            $this->parseURL();
        }

        if (!isset($this->url['path'])) {
            return 'fallback';
        }
        $urlSegment = explode('/', $this->url['path']);
        $urlSegment = array_filter($urlSegment);
        $urlSegment = $urlSegment[count($urlSegment)] ?? 'homepage';

        return $urlSegment;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->map[$this->url['path']]['action'] ?? 'indexAction';
    }

}