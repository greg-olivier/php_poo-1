<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:42
 */

namespace Controleur\Frontend;


use Modele\ArticleManager;


class BlogControleur extends \Lib\Controleur
{




    protected function indexAction()
    {
        $am = new ArticleManager();
        $last_articles = $am->getLastArticles();
        $data = ['last_articles' => $last_articles, 'titre' => 'Bienvenue sur le blog'];
        $this->render('blog/index.html.php', $data);
    }

    public function detailAction()
    {
        $id=$_GET['id'];
        $am = new ArticleManager();
        $current_article = $am->getArticleById($id);
        $data = ['current_article' => $current_article];
        $this->render('blog/article.html.php', $data);
    }
}