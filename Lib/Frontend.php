<?php

namespace Lib;


use Controleur\Frontend\BlogControleur;

class Frontend extends Application
{
    protected $controleur;


    public function __construct()
    {
        $this->name = 'Frontend';
        $this->layout = 'layout.html.php';
        //parent::__construct();
    }


    public function run()
    {
        $module = (isset($_GET['module'])) ? $_GET['module'] : 'blog';
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'index';

        try {
            $controleur = $this->getControleur($module);
            $controleur->action($action);
        } catch(HttpErrorException $e) {
            new \Controleur\Frontend\ErrorControleur($this, $e);
            exit;

        }

    }


}