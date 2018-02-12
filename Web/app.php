<?php
include '../Lib/AutoLoad.php';

if (preg_match('/admin|connexion|membre/',$_SERVER['REQUEST_URI'])=== 1) {
    $app = new \Lib\Backend();
    $app->run();
} else {
    $app = new \Lib\Frontend();
    $app->run();
}