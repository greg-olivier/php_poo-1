<?php
namespace Modele;

use Lib\Application;
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
    
    public function deleteArticleById($id){
        
        //// Action Delete images à mettre dans une classe Image
       /* $sql = 'SELECT image FROM article WHERE id = ?';
        $result = $this->prepare($sql);
        $result->execute([$id]);
        $file_img = $result->fetch();

        unlink(Application::RACINE.'images/'.$file_img['image']);*/

        $sql = 'DELETE FROM article WHERE id = ?';
        $result = $this->prepare($sql);
        $result->execute([$id]);
    }

    /**
     * @param Auteur $auteur
     */
    public function getArticlePubByAuteur(Auteur $auteur){

        // Articles publiés
        $sql = 'SELECT id, titre, contenu, publier, slug FROM article WHERE id_auteur = ? AND publier = 1 ORDER BY date DESC';
        $result = $this->prepare($sql);
        $result->execute([$auteur->getId()]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Article::class);
        $all_articles_pub = $result->fetchAll();

        $sql = 'SELECT COUNT(id) nb FROM article WHERE id_auteur = ? AND publier = 1';
        $result = $this->prepare($sql);
        $result->execute([$auteur->getId()]);
        $nb_items = $result->fetch();
        $nb_items_pub = $nb_items['nb'];



        return ['all_articles_pub' => $all_articles_pub, 'nb_items_pub' => $nb_items_pub];
    }

    public function getArticleNoPubByAuteur(Auteur $auteur) {
        $sql = 'SELECT id, titre, contenu, publier, slug FROM article WHERE id_auteur = ? AND publier = 0 ORDER BY date DESC';
        $result = $this->prepare($sql);
        $result->execute([$auteur->getId()]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Article::class);
        $all_articles_nopub = $result->fetchAll();

        $sql = 'SELECT COUNT(id) nb FROM article WHERE id_auteur = ? AND publier = 0';
        $result = $this->prepare($sql);
        $result->execute([$auteur->getId()]);
        $nb_items = $result->fetch();
        $nb_items_nopub = $nb_items['nb'];

        return ['all_articles_nopub' => $all_articles_nopub, 'nb_items_nopub' => $nb_items_nopub];
    }

    public function addArticle(Article $article){
        $sql = 'INSERT INTO article (titre, contenu, date, id_auteur, slug, image, publier)
                            VALUES (?, ?, ?, ?, ?, ?, ?)';
        $result = $this->prepare($sql);
        $result->execute([$article->getTitre(), $article->getContenu(), $article->getDate()->format('Y-m-d H:i:s'), $article->getAuteur()->getId(), $article->getSlug(), $article->getImage(), $article->getPublier()]);
    }

    public function getLastId(){
        $sql = 'SELECT id FROM article ORDER BY id DESC LIMIT 1';
        $result = $this->query($sql);
        $lastid = $result->fetch();
        return $lastid['id'];
    }

}