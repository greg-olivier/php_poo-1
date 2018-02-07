<?php
namespace Modele;


use Tools\Date_Locale;
use Tools\Extrait;

Class Article extends \Lib\Entite
{
    use Date_Locale;
 use Extrait;

// Attributs
    /**
     * @var string
     */
    private $titre;

    /**
     * @var sring
     */
    private $contenu;

    /**
     * @var Auteur
     */
    private $auteur;


    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $image = null;
    

    /**
     * @var string
     */
    private $publier;


// Constantes


// Méthodes


/////// Constructeur

public function __construct(array $data = [])
{
    $this->date = new \DateTime();
    $this->auteur = new Auteur();
    parent::__construct($data);
}

////// Getter & Setter


    public function getTitre()
    {
        return $this->titre;
    }


    public function setTitre($titre)
    {
        if (strlen($titre) <= 2)
            $this->erreur[] = 'Titre non rempli';
        else
            $this->titre = $titre;
        return $this;
    }


    public function getContenu()
    {
        return $this->contenu;
    }

    public function getExtrait()
    {
        return $this->extr($this->getContenu());
    }


    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function getId()
    {
        return $this->id;
    }


    /**
     * @param string $format
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @param \DateTime $date
     * @return Article
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
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
     * @return $this
     */
    public function setAuteur(Auteur $auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublier()
    {
        return $this->publier;
    }

    /**
     * @param string $publier
     * @return Article
     */
    public function setPublier($publier)
    {
        $this->publier = $publier;
        return $this;
    }





////// Logique métier

    /*protected function hydratation(array $data = [])
    {
    foreach ($data as $key => $value) {
    $setter = 'set' . ucfirst($key);
    if (method_exists($this, $setter))
    $this->$setter($value);
    }

    }*/

}