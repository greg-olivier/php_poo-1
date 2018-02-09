<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 10:59
 */

namespace Modele;


use Lib\EntiteManager;
use \PDO;

class AuteurManager extends EntiteManager
{
    public function getAuteurById($id){
        
        $sql = 'SELECT  id_auteur id, titre, login_auteur nom, pwd_auteur pass FROM auteur
            WHERE id_auteur = ?';
        $result =  $this->prepare($sql);
        $result->execute([$id]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Auteur::class);
        return $result->fetch();
    }

    public function getAuteurToLogin(Auteur $auteur){
        $sql = 'SELECT id_auteur id, login_auteur nom, pwd_auteur pass, titre FROM auteur WHERE login_auteur = ?';
        $result = $this->prepare($sql);
        $result->execute([$auteur->getNom()]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Auteur::class);
        return $result->fetch();
    }

}