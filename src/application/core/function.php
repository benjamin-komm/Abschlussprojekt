<?php declare(strict_types = 1);

/*
 * Debug a variable and die
 */
function dd($v) {
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

    if (null === $v) {
        $v = 'NULL';
    } elseif ($v === true) {
        $v = 'true';
    } elseif ($v === false) {
        $v = 'false';
    } elseif ($v === '') {
        $v = '"-EMPTY STRING-"';
    }

    $cli = php_sapi_name() === 'cli';
    if (!$cli) {
        echo '<pre>';
    }
    print_r($trace['file'] . ':' . $trace['line']);
    echo "\n";
    print_r($v);
    if (!$cli) {
        echo '</pre>';
    } else {
        echo "\n";
    }
    die;
}

/*
 * Debug a variable
 */
function d($v) {
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

    if (null === $v) {
        $v = 'NULL';
    } elseif ($v === true) {
        $v = 'true';
    } elseif ($v === false) {
        $v = 'false';
    } elseif ($v === '') {
        $v = '"-EMPTY STRING-"';
    }

    $cli = php_sapi_name() === 'cli';
    if (!$cli) {
        echo '<pre>';
    }
    print_r($trace['file'] . ':' . $trace['line']);
    echo "\n";
    print_r($v);
    if (!$cli) {
        echo '</pre>';
    } else {
        echo "\n";
    }
}
