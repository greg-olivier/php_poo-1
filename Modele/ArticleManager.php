<?php

namespace Modele;

use Lib\Application;
use Lib\EntiteManager;
use \PDO;

Class ArticleManager extends EntiteManager
{


    /**
     * @param int $limit
     * @return array
     */
    public function getLastArticles($limit = 3)
    {

        $sql = 'SELECT id, titre, contenu, date, slug, thumbnail, id_auteur auteur FROM article order by date DESC LIMIT ?';
        $result = $this->prepare($sql);
        $result->bindParam(1, $limit, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Article::class);

        $articles = $result->fetchAll();


        foreach ($articles as $article) {
            $article->setDate(new \DateTime($article->getDate()));

            $am = new AuteurManager;
            $article->setAuteur($am->getAuteurById($article->getAuteur()));


            $thumb_bdd = $article->getThumbnail();
            $article->setThumbnail(new Thumbnail);
            $article->getThumbnail()->setFilename($thumb_bdd);

        }
        return $articles;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getArticleById($id)
    {


        $sql = 'SELECT id, titre, date, image, thumbnail, contenu, slug, id_auteur auteur, publier FROM article WHERE id = ?';
        $result = $this->prepare($sql);
        $result->execute([$id]);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Article::class);
        $article = $result->fetch();
        $article->setDate(new \DateTime($article->getDate()));

        $am = new AuteurManager;
        $article->setAuteur($am->getAuteurById($article->getAuteur()));

        $image = new \Modele\Image();
        $img_bdd = $article->getImage();
        $article->setImage($image);
        $article->getImage()->setFilename($img_bdd);

        $thumbnail = new \Modele\Thumbnail();
        $thumb_bdd = $article->getThumbnail();
        $article->setThumbnail($thumbnail);
        $article->getThumbnail()->setFilename($thumb_bdd);


        return $article;

    }

    public function deleteArticle(Article $article)
    {
        if($article->getImage()->getFilename() !== null) {
            $sql = 'SELECT image nom FROM article WHERE id = ?';
            $result = $this->prepare($sql);
            $result->execute([$article->getId()]);
            $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Image::class);
            $file_img = $result->fetch();

            $file_img->deleteImage();
        }
        if($article->getThumbnail()->getFilename() !== null) {
            $sql = 'SELECT thumbnail nom FROM article WHERE id = ?';
            $result = $this->prepare($sql);
            $result->execute([$article->getId()]);
            $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Thumbnail::class);
            $file_thumb = $result->fetch();

            $file_thumb->deleteThumbnail();
        }

        $sql = 'DELETE FROM article WHERE id = ?';
        $result = $this->prepare($sql);
        $result->execute([$article->getId()]);
    }

    /**
     * @param Auteur $auteur
     */
    public function getArticlePubByAuteur(Auteur $auteur)
    {

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

    public function getArticleNoPubByAuteur(Auteur $auteur)
    {
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

    public function addArticle(Article $article)
    {
        $sql = 'INSERT INTO article (titre, contenu, date, id_auteur, image, thumbnail, publier)
                            VALUES (?, ?, ?, ?, ?, ?, ?)';
        $result = $this->prepare($sql);
        $result->execute([$article->getTitre(), $article->getContenu(), $article->getDate()->format('Y-m-d H:i:s'), $article->getAuteur()->getId(), $article->getImage()->getFilename(), $article->getThumbnail()->getNom(), $article->getPublier()]);
        $article->setSlug($article->getTitre(),$this->getBdd()->lastInsertId());

        $sql = 'UPDATE article set slug=?  Where id =?';
        $result = $this->prepare($sql);
        $result->execute([$article->getSlug(),$this->getBdd()->lastInsertId()]);
    }

    public function updateArticle(Article $article){
        $sql = 'UPDATE article SET titre = ?, contenu = ?, image = ?, thumbnail = ?, date = ? ,publier = ? WHERE id = ?';
        $result = $this->prepare($sql);
        $result->execute([$article->getTitre(), $article->getContenu(), $article->getImage()->getFilename(), $article->getThumbnail()->getFilename(),  $article->getDate()->format('Y-m-d H:i:s'), $article->getPublier(), $article->getId()]);
    }

}