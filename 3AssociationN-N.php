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

$commande =  \commandeApp\model\commande::where("id", "=", "000b2a0b-d055-4499-9c1b-84441a254a36")->with("items")->get();

/*echo $commande;*/

/*question 2*/
$items = \commandeApp\model\item::with("commandeItem")->get();
/*echo $items;*/

/*question 3*/

$commande1 =  \commandeApp\model\commande::where("nom_client", "=", "Aaron McGlynn")->with("items")->get();

/*echo $commande1; */

/*question 4*/

$commande3 = \commandeApp\model\commande::where("id", "=", "cccc-cccc-5570")->first();

/*$commande3->items()->attach(\commandeApp\model\item::find(2),["quantite"=>3]);
$commande3->items()->attach(\commandeApp\model\item::find(6),["quantite"=>4]);*/

/*question 5*/

$commande3->items()->attach(\commandeApp\model\item::find(6),["quantite"=>6]);
$commande3->save();

