<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 06/02/2018
 * Time: 13:42
 */

namespace Controleur\Backend;


use Lib\Application;
use Modele\Auteur;
use Modele\AuteurManager;
use Tools\Token_Form;

class ConnexionControleur extends \Lib\Controleur
{


    use Token_Form;


    public function indexAction(\Modele\Auteur $auteur)
    {
        $token = $this->token_form();
        $this->render('connect/connect.html.php', ["token" => $token, "erreurs" => $auteur->getErreur()]);

    }

    /**
     * @param \Modele\Auteur $auteur
     */
    public function connectAction(\Modele\Auteur $auteur)
    {
                $am = new \Modele\AuteurManager();
                $auteur_bdd = $am->getAuteurByNom($auteur);
                
                if ($auteur_bdd === False) {
                    $auteur->setErreur(['Identifiant et/ou mot de passe non-reconnu(s)']);
                } elseif (password_verify($auteur->getPass(), $auteur_bdd->getPass()) === False) {
                    $auteur->setErreur(['Identifiant et/ou mot de passe non-reconnu(s)']);
                    sleep(1);
                } else {
                    $_SESSION['IPaddress'] = sha1($_SERVER['REMOTE_ADDR']);
                    $_SESSION['userAgent'] = sha1($_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['auteur'] = $auteur_bdd;
                    $_SESSION['auth'] = true;
                    header('Location: ' . Application::$racine . $auteur_bdd->getRole());
                    exit;
                }
            }

    public function disconnectAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['confirm'] === 'OK') {
                session_destroy();
                setcookie(session_name(), session_id(), time() - 10, '/', null, null, true);
                header('Location: '.Application::$racine.'connexion');
                exit();
            } else {
                header('Location: '.Application::$racine.$_SESSION['auteur']->getRole());
                exit();
            }
        }
        $this->render('connect/disconnect.html.php');
    }

    public function registerAction()
    {
        $auteur = new Auteur;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['token'])) {
                header('Location: ?page=register');
                exit();
            } else {

                if ($_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_time'] <= Application::TIME_STORE_TOKEN) {

                    $auteur->setNom($_POST['login']);
                    $auteur->setPass($_POST['pass']);

                    $am = new AuteurManager();
                    $am->getAuteurByNom($auteur);
                    if ($am->getAuteurByNom($auteur)!== false) {
                        $auteur->setErreur(['Login déjà pris. Essayez en un autre']);
                    }

                    if ($auteur->getErreur() == []) {
                            $am->insertAuteur($auteur);
                            $this->connectAction($auteur);
                            header('Location: '.Application::$racine.'membre');
                            exit();

                    }
                }
            }
        }
        $token = $this->token_form();
        $this->render('connect/register.html.php', ["token" => $token, "erreurs" => $auteur->getErreur()]);
    }
}