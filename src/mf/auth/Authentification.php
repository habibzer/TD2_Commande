<?php

namespace mf\auth;


class Authentification extends AbstractAuthentification{


    /*
     * Le constructeur :
     *
     * Faire le lien entre la variable de session et les attributs de la calsse
     *
     *   La variables de session sont les suivante :
     *    - $_SESSION['user_login']
     *    - $_SESSION['access_level']
     *
     *  Algorithme :
     *
     *  Si la variable de session 'user_login' existe
     *
     *     - renseigner l'attribut $this->user_login avec sa valeur
     *     - renseigner l'attribut $this->access_level avec la valeur de
     *       la variable de session 'access_level'
     *     - mettre l'attribut $this->logged_in a vrai
     *
     *  sinon
     *     - mettre les valeurs : null, ACCESS_LEVEL_NONE et false
     *       respectivement dans les trois attributs.
     *
     */

    public function __construct()
    {
        if(isset($_SESSION['user_login'])){
            $this->user_login = $_SESSION['user_login'];
            $this->access_level = $_SESSION['access_level'];
            $this->logged_in = true;
        }else{
            $this->user_login = null;
            $this->access_level = self::ACCESS_LEVEL_NONE;
            $this->logged_in = false;
        }

    }


    /*
     * La méthode updateSession :
     *
     * Méthode pour enregistrer la connexion d'un utilisateur dans la session
     *
     * ATTENTION : cette méthode est appelée uniquement quand la connexion
     *             réussie par la méthode login (cf. plus bas)
     *
     * @param String : $username, le login de l'utilisateur
     * @param String : $level, le niveau d'accès
     *
     *  Algorithme:
     *    - renseigner l'attribut $this->user_login avec le paramètre $username
     *    - renseigner l'attribut $this->access_level avec $level
     *
     *    - renseigner $_SESSION['user_login']  $username
     *    - renseigner $_SESSION['access_level'] $level

     *    - mettre l'attribut $this->logged_in à vrai
     *
     */

     protected function updateSession($username, $level){

         $this->user_login = $username;
         $this->access_level = $level;
         $_SESSION['user_login'] = $username;
         $_SESSION['access_level'] = $level;

         $this->logged_in = true;


     }

    /*
     * la méthode logout :
     *
     * Méthode pour effectuer la déconnexion :
     *
     * Algorithme :
     *
     *  - Effacer les variables $_SESSION['user_login'] et
     *    $_SESSION['access_right']
     *  - Réinitialiser les attributs $this->user_login, $this->access_level
     *  - Mettre l'attribut $this->logged_in a faux
     *
     */

     public function logout(){

         unset($_SESSION['user_login']);
         unset($_SESSION['access_level']);
         $this->user_login = null;
         $this->access_level = self::ACCESS_LEVEL_NONE;
         $this->logged_in = false;

     }


    /*
     * La méthode checkAccessRight:
     *
     * Méthode pour verifier le niveau d'accès de l'utilisateur.
     *
     * @param  int  : $requested, le niveau requis
     * @return bool : vrai si le niveaux requis est inférieur ou égale à la
     *                valeur du niveau de l'utilisateur
     *
     * Algorithme :
     *
     * Si $requested > $this->access_level
     *     retourner faux
     * Sinon
     *     retourner vrai
     */

     public function checkAccessRight($requested){

         if($requested > $this->access_level){

             return false;

         }else{

             return true;

         }

     }

    /*
     * La méthode login:
     *
     * Méthode qui réalise la connexion d'un utilisateur.
     *
     * @param string : $username, l'identifiant fourni par l'utilisateur
     * @param string : $db_pass, le haché du mot de passe stocké en BD
     * @param string : $pass, le mot de passe fourni par l'utilisateur
     * @param integer: $level, le niveau d'accès de lutilisateur stocké en BD
     *
     * Algorithme :
     *
     *   Si le mot de passe ne corespond pas au haché
     *       Soulever une exception
     *   sinon
     *       Mettre a jour les variables de session (update_session)
     *
     */

     public function login($username, $db_pass, $given_pass, $level){

         if (password_verify($given_pass, $db_pass)) {

             $this->updateSession($username, $level);

         }else{

             echo "mot de passe invalid !";

         }

     }

    /*
     * La méthode hashPassword :
     *
     * Méthode pour hacher un mot de passe
     *
     * @param  string : $password, le mots de passe en clair
     * @return string : mot de passe haché
     *
     * Algorithme :
     *
     *   Retourner le résultat de la fonction password_hash
     *
     */

     protected function hashPassword($password){

         $passwordHash =  password_hash("$password", PASSWORD_DEFAULT);

         return $passwordHash;
     }

    /*
     * La méthodes verifyPassword :
     *
     * Méthode pour vérifier si un mot de passe est égale a un hache
     *
     * @param string : $password, mot de passe non haché (depuis un formulaire)
     * @param string : $hash, le mot de passe haché (depuis BD)
     * @return bool  : vrai si concordance faut sinon
     *
     *
     * Algorithme :
     *
     *  Retourner le résultat de la fonction password_verify
     */

     protected function verifyPassword($password, $hash){

         $result = password_verify($password, $hash);
         return $result;



     }
}