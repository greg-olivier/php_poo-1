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
                $auteur_bdd = $am->getAuteurToLogin($auteur);
                
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
                    header('Location: ' . Application::RACINE . 'admin');
                    exit;
                }
            }

    public function disconnectAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['confirm'] === 'OK') {
                session_destroy();
                setcookie(session_name(), session_id(), time() - 10, '/', null, null, true);
                header('Location: '.Application::RACINE.'connexion');
                exit();
            } else {
                header('Location: '.Application::RACINE.'admin');
                exit();
            }
        }
        $this->render('connect/disconnect.html.php');
    }
}