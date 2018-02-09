<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:42
 */

namespace Controleur\Backend;


class AdminControleur extends \Lib\Controleur
{
    
    protected function indexAction()
    {
        $auteur = $_SESSION['auteur'];
        $am = new \Modele\ArticleManager();
        $all_articles_nopub = $am->getArticleNoPubByAuteur($auteur);
        $all_articles_pub =  $am->getArticlePubByAuteur($auteur);
        $data = array_merge($all_articles_nopub, $all_articles_pub);
        $this->render('admin/list.html.php', $data);
    }
    
}