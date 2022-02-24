<?php declare(strict_types=1);

namespace core\MVC;

class View {

    private array $assigns = [];
    private string $content = '';
    private string $layoutViewPath = APP_VIEWS_ROOT . '/Layouts/ProjectManagerLayout.phtml';
    private array $views = [];

    public function render(): View {
        $this->assignAssets();
        $this->setContent(doRendering($this->getAssigns(), $this->getViews(), $this->getLayoutViewPath()));
        return $this;
    }

    /**
     * @return View
     */
    private function assignAssets(): View {
        $cssPath = APP_ASSETS_ROOT . '/styles/' . ACTIVE_PAGE . '/';
        $cssFiles = glob($cssPath . '*.{css}', GLOB_BRACE);
        $jsPath = APP_ASSETS_ROOT . '/scripts/' . ACTIVE_PAGE . '/';
        $jsFiles = glob($jsPath . '*.{js}', GLOB_BRACE);

        //remove chars before /assets/
        foreach ($cssFiles as &$cssFile) {
            $cssFile = strstr($cssFile, '/assets/');
            $cssFile = '/src/public' . $cssFile;
        }
        foreach ($jsFiles as &$jsFile) {
            $jsFile = strstr($jsFile, '/assets');
            $jsFile = '/src/public' . $jsFile;
        }

        $this->assign('css-files', $cssFiles);
        $this->assign('js-files', $jsFiles);

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return View
     */
    public function assign($key, $value): View {
        $this->assigns[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getAssigns(): array {
        return $this->assigns;
    }

    /**
     * @return array
     */
    public function getViews(): array {
        return $this->views;
    }

    /**
     * @return string
     */
    public function getLayoutViewPath(): string {
        return $this->layoutViewPath;
    }

    /**
     * @param string $layoutViewPath
     * @return View
     */
    public function setLayoutViewPath(string $layoutViewPath): View {
        $this->layoutViewPath = $layoutViewPath;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function addView(string $path): View {
        array_push($this->views, APP_VIEWS_ROOT . '/' . $path);
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     * @return View
     */
    public function setContent(string $content): View {
        $this->content = $content;
        return $this;
    }

}

/**
 * @param array $assigns
 * @param array $views
 * @param string $layoutViewPath
 * @return string
 */
function doRendering(array $assigns, array $views, string $layoutViewPath): string {
    $assigns['content'] = '';
    foreach ($views as $view) {
        ob_start();
        require $view;
        $assigns['content'] .= ob_get_clean();
    }

    ob_start();
    require $layoutViewPath;
    return ob_get_clean();
}