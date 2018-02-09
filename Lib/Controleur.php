<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:39
 */

namespace Lib;


abstract class Controleur
{

    /**
     * @var Application
     */
    protected $app;
    const RACINE = '/php/exoobjet/web/';

    public function __construct($app)
    {
        $this->app = $app;

    }

    public function action($action)
    {
        $methode = $action . 'Action';
        if (!method_exists($this, $methode))
            throw new HttpErrorException("Action non définie pour ce module", 404);
        $this->$methode();


    }


    protected function render($vue, array $data = [])
    {
        extract($data); // la fonction "extract" permet de créer des variables (contenant les valeurs lié à la clé) en fonction des clés d'un tableau
        ob_start();
        include __DIR__ . '/../Vue/' . $vue;
        $contenu = ob_get_clean();
        include __DIR__ . '/../Vue/' . $this->app->getLayout();

    }

}