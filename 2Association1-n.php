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
$carte = \commandeApp\model\Carte::find(42);

/*echo $carte->commandes()->get();*/

/*question 2*/

$Cartes =  \commandeApp\model\Carte::select()->where("cumul", ">", 1000)->with("commandes")->get();

/*echo $Cartes;*/

/*question 3*/

$Commandes = \commandeApp\model\commande::select()->whereNotNull("carte_id")->with("SaCarte")->get();

/*echo $Commandes;*/

/*question4*/

$commande1 = new \commandeApp\model\commande();
$commande1->id = "aaaa-aaaa-5570";
$commande1->carte_id = 10;
$commande1->date_livraison = "2019-10-15";
$commande1->etat = 1;

$commande2 = new \commandeApp\model\commande();
$commande2->id = "bbbb-bbbb-5570";
$commande2->carte_id = 10;
$commande2->date_livraison = "2019-10-15";
$commande2->etat = 1;

$commande3 = new \commandeApp\model\commande();
$commande3->id = "cccc-cccc-5570";
$commande3->carte_id = 10;
$commande3->date_livraison = "2019-10-15";
$commande3->etat = 1;

/*$commande1->save();
$commande2->save();
$commande3->save();*/

/*question 5*/

$majCommande3 =  \commandeApp\model\commande::where("id","=","cccc-cccc-5570")->update(["carte_id" => 11]);

