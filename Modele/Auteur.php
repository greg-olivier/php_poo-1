<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 10:58
 */

namespace Modele;

Use Exception;
use Lib\Entite;

class Auteur extends Entite
{
    private $nom, $pass, $titre;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Auteur
     */
    public function setNom($nom)
    {
        if (strlen($nom) < 3)
            $this->erreur[] .= "Login non-rempli ou trop court<br>";
        else
            $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return mixed
     */
    public function getPassHash()
    {
        return password_hash($this->pass, PASSWORD_DEFAULT);
        
    }

    /**
     * @param mixed $pass
     * @return Auteur
     */
    public function setPass($pass)
    {
        if (strlen($pass) < 3)
            $this->erreur[] .= "Votre mot de passe doit avoir au moins 3 caractères<br>";
        else
            $this->pass = $pass;
            return $this;
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
     * @return Auteur
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }


    public function getRole()
    {
        if ($this->getTitre() == 'admin')
            return 'admin';
        elseif ($this->getTitre() == 'membre')
            return 'membre';
        else
            return 'erreur';
    }
    

    public function __sleep() {
        return ['id','nom', 'titre'];
    }

    public function cryptPass($pass){
        return $this->pass = password_hash($pass, PASSWORD_DEFAULT);
    }

}