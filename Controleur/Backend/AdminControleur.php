<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:42
 */

namespace Controleur\Backend;


use Lib\Application;
use Modele\ArticleManager;
use Modele\Image;
use Modele\Thumbnail;
use Tools\Token_Form;
use Tools\Upload_Image;

class AdminControleur extends \Lib\Controleur
{
    use Upload_Image;
    use Token_Form;

    protected function indexAction()
    {
        $auteur = $_SESSION['auteur'];
        $am = new \Modele\ArticleManager();
        $all_articles_nopub = $am->getArticleNoPubByAuteur($auteur);
        $all_articles_pub = $am->getArticlePubByAuteur($auteur);
        $data = array_merge($all_articles_nopub, $all_articles_pub);
        $this->render('admin/list.html.php', $data);
    }

    protected function detailAction()
    {
        $id = $_GET['id'];
        $am = new \Modele\ArticleManager();
        $current_article = $am->getArticleById($id);
        $data = ['current_article' => $current_article];
        $this->render('admin/detail-article.html.php', $data);
    }

    protected function addAction()
    {
        $article = new \Modele\Article();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['token'])) {
                header('Location: /admin/add');
                exit();
            } else {
                if (($_POST['token'] == $_SESSION['token']) && (time() - $_SESSION['token_time']) <= Application::TIME_STORE_TOKEN) {

                    $article->setTitre($_POST['titre']);
                    $article->setContenu($_POST['contenu']);
                    if ($_FILES['fichier_image']['name'] !== '') {
                        $image = new \Modele\Image();
                        $image->setFile($_FILES['fichier_image']);
                        $image->setNom($_FILES['fichier_image']['name']);
                        $image->setMime($_FILES['fichier_image']['type']);
                        $image->setExt($_FILES['fichier_image']['name']);
                        $image->setFilename($image->encodeFilename());
                        $article->setImage($image);
                    } else {
                        $image = NULL;
                    }
                    if (isset($_POST['publier'])) {
                        $article->setPublier(1);
                    } else {
                        $article->setPublier(0);
                    }
                    if ($image != null) {
                        if (!is_dir(\Modele\Image::IMAGES)) {
                            mkdir(\Modele\Image::IMAGES);
                        }


                        $upload = $article->getImage()->uploadImage();

                        if ($upload === true)
                            if (!is_dir(Thumbnail::THUMB)) {
                                mkdir(Thumbnail::THUMB);
                            }

                        $thumbnail = $article->getThumbnail()->thumbnail(Image::IMAGES . $article->getImage()->getFilename());


                        if ($article->getImage()->getErreur() != [] OR $article->getThumbnail()->getErreur() != []) {
                            $erreur_img = $article->getImage()->getErreur();
                            $erreur_thumb = $article->getImage()->getErreur();
                            $erreurs = array_merge($erreur_img, $erreur_thumb);
                            $article->setErreur($erreurs);
                        }
                    }

                    if ($article->getErreur() == []) {
                        $am = new \Modele\ArticleManager();
                        $article->setAuteur($_SESSION['auteur']);
                        $article->setDate(new \DateTime('now'));
                        if ($image !== null)
                            $article->getThumbnail()->setNom($thumbnail);

                        $am->addArticle($article);
                        header('Location: ' . Application::RACINE . 'admin/index');
                        exit();
                    }
                }
            }
        }
        $token = $this->token_form();
        $data = ["token" => $token, "erreurs" => $article->getErreur()];
        $this->render('admin/add-article.html.php', $data);
    }

    protected function deleteAction()
    {

        $id = $_GET['id'];
        $am = new \Modele\ArticleManager();
        $article = $am->getArticleById($id);
        $am->deleteArticle($article);

        header('Location: ' . Application::RACINE . '/admin/index');
        exit();
    }

    protected function editAction()
    {
        $id = $_GET['id'];
        $article = new \Modele\Article();
        $am = new ArticleManager();
        $article_edit = $am->getArticleById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['token'])) {
                header('Location: /admin/add');
                exit();
            } else {
                if (($_POST['token'] == $_SESSION['token']) && (time() - $_SESSION['token_time']) <= Application::TIME_STORE_TOKEN) {

                    $article->setTitre($_POST['titre']);
                    $article->setContenu($_POST['contenu']);

                    if ($_FILES['fichier_image']['name'] !== '') {
                        $image = new \Modele\Image();
                        $image->setFile($_FILES['fichier_image']);
                        $image->setNom($_FILES['fichier_image']['name']);
                        $image->setMime($_FILES['fichier_image']['type']);
                        $image->setExt($_FILES['fichier_image']['name']);
                        $image->setFilename($image->encodeFilename());
                        $article->setImage($image);
                    } else {
                        $article->getImage()->setFilename($article_edit->getImage()->getFilename());
                        $article->getThumbnail()->setFilename($article_edit->getThumbnail()->getFilename());
                    }
                    if (isset($_POST['publier'])) {
                        $article->setPublier(1);
                    } else {
                        $article->setPublier(0);
                    }
                    if ($article->getImage()->getFilename() != $article_edit->getImage()->getFilename()) {
                        if (!is_dir(\Modele\Image::IMAGES)) {
                            mkdir(\Modele\Image::IMAGES);
                        }


                        $upload = $article->getImage()->uploadImage();

                        if ($upload === true)
                            if (!is_dir(Thumbnail::THUMB)) {
                                mkdir(Thumbnail::THUMB);
                            }

                        $thumbnail = $article->getThumbnail()->thumbnail(Image::IMAGES . $article->getImage()->getFilename());


                        if ($article->getImage()->getErreur() != [] OR $article->getThumbnail()->getErreur() != []) {
                            $erreur_img = $article->getImage()->getErreur();
                            $erreur_thumb = $article->getImage()->getErreur();
                            $erreurs = array_merge($erreur_img, $erreur_thumb);
                            $article->setErreur($erreurs);
                        }
                    }

                    if ($article->getErreur() == []) {
                        $am = new \Modele\ArticleManager();
                        $article->setId($article_edit->getId());
                        $article->setAuteur($_SESSION['auteur']);
                        $article->setDate(new \DateTime('now'));
                        if ($article->getImage()->getFilename() != $article_edit->getImage()->getFilename())
                            $article->getThumbnail()->setNom($thumbnail);
                        $am->updateArticle($article);
                        header('Location: ' . Application::RACINE . 'admin/index');
                        exit();
                    }
                }
            }
        }
        $token = $this->token_form();
        $data = ["token" => $token, "erreurs" => $article->getErreur(), "article_edit" => $article_edit];
        $this->render('admin/edit.html.php', $data);
    }
}