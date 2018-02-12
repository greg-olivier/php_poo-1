<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 12/02/2018
 * Time: 09:37
 */

namespace Controleur\Backend;


use Lib\Application;
use Lib\Controleur;
use Modele\ArticleManager;
use Modele\ProductManager;

class MembreControleur extends Controleur
{

    public function indexAction()
    {
        if (!isset($_SESSION['auth']) AND $_SESSION['auth'] !== true) {
            header('Location: ' . Application::$racine . '/connexion/connect');
            exit();
        } else if (($_SESSION['auteur']->getRole()) == 'membre') {

            if ($_SESSION['IPaddress'] != sha1($_SERVER['REMOTE_ADDR']) || ($_SESSION['userAgent'] != sha1($_SERVER['HTTP_USER_AGENT'])))
                exit('Grrr');
            $am = new ArticleManager();
            $last_articles = $am->getLastArticles();
            $pm = new ProductManager();
            $last_pdts = $pm->getLastProducts();

            $this->render('membre/membre.html.php', ["last_articles" => $last_articles, "last_pdts" => $last_pdts]);

        }
    }


}