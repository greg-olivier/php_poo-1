<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:43
 */

namespace Lib;


use Tools\Slugify;

abstract class Entite
{
    
    use Slugify;
    
 protected $id, $slug,$erreur = [];



    public function __construct(array $data = [])
    {
        $this->hydratation($data);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Entite
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    
    /**
     * @return array
     */
    public function getErreur()
    {
        return $this->erreur;
    }

    /**
     * @param array $erreur
     * @return Entite
     */
    public function setErreur(array $erreur)
    {
        $this->erreur = $erreur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return Entite
     */
    public function setSlug($text, $id)
    {
        $slug = $this->slugify($text).'-'.$id;
        $this->slug = $slug;
        return $this;
    }
    

    


    public function hydratation(array $data = [])
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter))
                $this->$setter($value);
        }
    }
}