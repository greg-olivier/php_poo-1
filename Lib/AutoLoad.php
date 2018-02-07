<?php
function autoLoad($class) {
    $file = '../'.str_replace('\\', '/', $class) . '.php';
    if (file_exists($file))
        include $file;
}

spl_autoload_register('autoLoad');