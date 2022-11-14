<?php 

require_once("models/Model.inc.php");
require_once("actions/Action.inc.php");


class LoginAction extends Action {

   /**
    * Traite les données envoyées par le visiteur via le formulaire de connexion
    * (variables $_POST['nickname'] et $_POST['password']).
    * Le mot de passe est vérifié en utilisant les méthodes de la classe Database.
    * Si le mot de passe n'est pas correct, on affecte la chaîne "erreur"
    * à la variable $loginError du modèle. Si la vérification est réussie,
    * le pseudo est affecté à la variable de session et au modèle.
    *
    * @see Action::run()
    */

    public function run(){
        // determiner le modèle
        $model = new MessageModel;
        // determiner la vue
        $this->setView(getViewByName('Message'));

        if ($this->database->checkPassword($_POST['nickname'], $_POST['password'])){

            $model->setMessage('Connection ok, bienvenue parmis nous');
            $model->setLogin($_POST['nickname']);

            $this->setModel($model);
            $this->setSessionLogin($_POST['nickname']);

        } else {

            $model->setLoginError( "erreur");
            $model->setMessage('Il y a une erreur dans votre nickname ou votre mot de passe');

            $this->setModel($model);

        }


    }
}


