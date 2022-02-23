<?php declare(strict_types=1);

require_once 'function.php';

spl_autoload_register(function($class) {
    $segments = explode('\\', $class);
    $file = APP_APPLICATION_ROOT;
    for ($i = 0; $i < count($segments); $i++){
        if ($i == (count($segments)-1)){
            $file .= '/' . $segments[$i] . '.php';
            continue;
        }
        $file .= '/' . $segments[$i];
    }
    /*
    $segments = explode('\\', $class);
    $mainDirectory = lcfirst(array_shift($segments));
    if ($mainDirectory === 'core') {
        $file = APP_APPLICATION_ROOT . '/' . $mainDirectory . '/' . implode('/', $segments) . '.php';
    } else {
        d('other');
        d(APP_APPLICATION_ROOT . '/src/' . str_replace('\\', '/', $class) . '.php');
        $file = APP_APPLICATION_ROOT . '/src/' . str_replace('\\', '/', $class) . '.php';
    }*/

    if (is_file($file)) {
        require_once $file;
    }

});
