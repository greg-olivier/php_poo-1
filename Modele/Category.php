<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 09:37
 */

namespace Modele;


use Lib\Entite;

class Category extends Entite
{
    private $titre, $nb;


    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     * @return Category
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNb()
    {
        return $this->nb;
    }

    /**
     * @param mixed $nb
     * @return Category
     */
    public function setNb($nb)
    {
        $this->nb = $nb;
        return $this;
    }


}