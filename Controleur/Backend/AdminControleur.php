<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:42
 */

namespace Controleur\Backend;


use Lib\Application;
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

                    if ($_FILES['fichier_image'] !== []) {
                        $image = $_FILES['fichier_image']['name'];
                        $image_id = $_FILES['fichier_image'];
                        $ext = pathinfo($image_id['name'], PATHINFO_EXTENSION);
                        $fileName = sha1(uniqid(rand(), true)) . '.' . $ext;
                    } else {
                        $image = NULL;
                    }
                    if (isset($_POST['publier'])) {
                        $article->setPublier(1);
                    } else {
                        $article->setPublier(0);
                    }


                    if (!is_dir('../Web/images/')) {
                        mkdir('../Web/images/');
                    }

                    $images_dir = scandir('../Web/images/');
                    if ($image !== '') {
                        if (($images_dir === FALSE) OR (array_search($fileName, $images_dir) === FALSE)) {
                            $upload_ok = $this->upload($image_id, '../Web/images/' . $fileName, 1000000, array('image/png', 'image/jpg', 'image/jpeg'));
                            if ($upload_ok === FALSE) {
                                $article->setErreur(['Problème lors du téléchargement du fichier. merci de recommencer']);
                            }

                        }
                    }

                    if ($article->getErreur() == []) {
                        $am = new \Modele\ArticleManager();
                        $article->setSlug($_POST['titre'],$am->getLastId()+1);
                        $article->setAuteur($_SESSION['auteur']);
                        $article->setDate(new \DateTime('now'));

                        $am->addArticle($article);
                        header('Location: '.Application::RACINE.'admin/index');
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
        $am->deleteArticleById($id);

        header('Location: '.Application::RACINE.'/admin/index');
        exit();
    }

    protected function editAction()
    {

    }
}