<?php

namespace Lib;


use Modele\Auteur;

abstract class Application
{
    protected $name, $layout;
    static public $racine;
    /**
     * @var Auteur $auteur
     */
    protected $auteur;

    const TIME_STORE_TOKEN = 5 * 60; // 5min -> temps de saisie des formulaires
    const TIME_STORE_CACHE = 24 * 3600; // 24h -> temps avant check si cache a été modifié
    const TIME_STORE_COOKIE = 12 * 3600; // 12h -> temps avant que le cookies ne soit plus valable


    public function __construct()
    {
        setlocale(LC_ALL, '');
        session_start();
        $dir = str_replace('\\', '/', realpath(__DIR__ . '/../'));
        $dir = str_replace($_SERVER["DOCUMENT_ROOT"], '', $dir);
        $dir .= '/Web/';
        self::$racine = $dir;

        if (isset($_SESSION['auteur']))
            $this->auteur = $_SESSION['auteur'];
        else
            $this->auteur = new \Modele\Auteur();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Application
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     * @return Application
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return Auteur
     */
    public function getAuteur()

    {

        return $this->auteur;
    }

    /**
     * @param Auteur $auteur
     * @return Application
     */
    public function setAuteur(Auteur $auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }


    public abstract function run();


    protected function getControleur($module)
    {
        $nomControleur = '\Controleur\\' . $this->name . '\\' . ucfirst($module) . 'Controleur';
        if (!class_exists($nomControleur))
            throw new HttpErrorException("Module non trouvé", 404);
        return new $nomControleur($this);
    }


}