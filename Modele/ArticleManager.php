<?php
namespace Modele;

use Lib\EntiteManager;
use \PDO;

Class ArticleManager extends EntiteManager {


    /**
     * @param int $limit
     * @return array
     */
    public function getLastArticles($limit = 3)
        {

        $sql = 'SELECT id, titre, contenu, date, slug, image, id_auteur auteur FROM article order by date DESC LIMIT ?';
        $result = $this->prepare($sql);
        $result->bindParam(1,$limit,PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Article::class);

        $articles = $result->fetchAll();

        foreach ($articles as $article) {
            $article->setDate(new \DateTime($article->getDate()));
            $am = new AuteurManager;
            $article->setAuteur($am->getAuteurById($article->getAuteur()));
        }
            return $articles;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getArticleById($id)
    {


        $sql = 'SELECT id, titre,date, image, contenu, slug, id_auteur auteur FROM article WHERE id = ?';
        $result = $this->prepare($sql);
        $result->execute([$id]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Article::class);
        $article = $result->fetch();
        $article->setDate(new \DateTime($article->getDate()));
        $am = new AuteurManager;
        $article->setAuteur($am->getAuteurById($article->getAuteur()));
        return $article;

    }


}