<?php
require_once 'vendor/autoload.php';
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */
require_once 'vendor/autoload.php';

$config = parse_ini_file('conf/config.ini');

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config ); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */

/*question 1*/

        $requet1 = \commandeApp\model\Carte::select("nom_proprietaire", "mail_proprietaire", "cumul")->get();

        /*echo $requet1;*/

        /*foreach ($requet1 as $uneCarte){

            echo $uneCarte. "<br>";
        }*/

/*question 2 */

        $requet2 = \commandeApp\model\Carte::select("nom_proprietaire", "mail_proprietaire", "cumul")->orderByDesc("nom_proprietaire")->get();

        /*echo $requet1;*/

        /*foreach ($requet2 as $uneCarte){

            echo $uneCarte. "<br>";
        }*/

/*question 3*/

        /*try {
            $requet3 = \commandeApp\model\Carte::select()->where("id", "=", "7342")->firstOrFail();
            echo $requet3;
        } catch (ModelNotFoundException $e) {

            echo "cette carte n'existe pas";

        }*/


/*question 4*/

        $requet4 = \commandeApp\model\Carte::select()->where("nom_proprietaire", "LIKE","%ariane%")->get();

        /*echo $requet4;*/

        /*foreach ($requet4 as $element){

            echo $element."<br>";
        }*/

/*question 5*/

        /*$nouvelleCarte  = new \commandeApp\model\Carte();
        $nouvelleCarte->password = "blabla";
        $nouvelleCarte->nom_proprietaire = "Habib";
        $nouvelleCarte->mail_proprietaire = "habib@gmail.com";

        $nouvelleCarte->save();*/
