<?php

namespace Lib;


use Controleur\Backend\ConnectControleur;
use Tools\Token_Form;

class Backend extends Application
{
    use Token_Form;

    protected $controleur;


    public function __construct()
    {
        $this->name = 'Backend';
        $this->layout = 'layout.html.php';
        parent::__construct();
    }


    public function run()
    {
        if (preg_match('/register/', $_SERVER['REQUEST_URI']) === 1) {
            $controleur = new \Controleur\Backend\ConnexionControleur($this);
            $controleur->registerAction();
        }
        elseif (!isset($_SESSION['auth']) or $_SESSION['auth'] !== true) {
            $controleur = new \Controleur\Backend\ConnexionControleur($this);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!isset($_SESSION['token'])) {
                    header('Location: ' . Application::RACINE . 'connexion/index');
                    exit();
                } else {
                    if ($_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_time'] <= Application::TIME_STORE_TOKEN) {
                        $this->auteur->setNom($_POST['nom']);
                        $this->auteur->setPass($_POST['pass']);
                        if ($this->auteur->getErreur() == [])
                            $controleur->connectAction($this->auteur);
                    }
                }
            }
            $controleur->indexAction($this->auteur);

        } else {
            $module = (isset($_GET['module'])) ? $_GET['module'] : 'connexion';
            $action = (isset($_GET['action'])) ? $_GET['action'] : 'index';
            try {
                $controleur = $this->getControleur($module);
                $controleur->action($action);
            } catch
            (HttpErrorException $e) {
                new \Controleur\Backend\ErrorControleur($this, $e);
                exit;
            }
        }

    }

}