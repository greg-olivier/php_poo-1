<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 09:20
 */

namespace Modele;


use Tools\Date_Locale;
use Tools\Extrait;

class Product extends \Lib\Entite
{
    Use Date_Locale;
    Use Extrait;
    
private $titre, $contenu, $image, $prix;

    /**
     * @var CategoryManager 
     */
private $category;

    /**
     * @var \DateTime 
     */
private $date;


    public function __construct(array $data = [])
    {
        $this->date = new \DateTime();
        $this->category = new CategoryManager();
        parent::__construct($data);
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     * @return Product
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     * @return Product
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    

    /**
     * @param mixed $date
     * @return Product
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     * @return Product
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return CategoryManager
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    
    

    public function getExtrait()
    {
        return $this->extr($this->getContenu());
    }

}