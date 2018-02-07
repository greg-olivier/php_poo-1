<?php

namespace Lib;


abstract class Application
{
    protected $name, $layout, $user;

    const RACINE = '/php/php_poo-1/web/';

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


    public abstract function run();


    protected function getControleur($module)
    {
        $nomControleur = '\Controleur\\' . $this->name . '\\' . ucfirst($module) . 'Controleur';
        if (!class_exists($nomControleur))
            throw new HttpErrorException("Module non trouvé", 404);
        return new $nomControleur($this);
}

}