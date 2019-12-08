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

/*Question 1*/

/*$item = \commandeApp\model\item::find(2);
$item->delete();*/


/*3.1*/

$commande =  \commandeApp\model\commande::where("id", "=", "000b2a0b-d055-4499-9c1b-84441a254a36")->with(["items"=> function ($q){
                                                                                                                    $q->withTrashed();
                                                                                                                    }])->get();
/*echo $commande;*/



/*3.2*/

/*$item1 = \commandeApp\model\item::find(1);
$item1->delete();*/

$items = \commandeApp\model\item::with("commandeItem")->withTrashed()->get();
/*echo $items;*/



/*3.3*/

/*$item1 = \commandeApp\model\item::find(6);
$item1->delete();*/

$commande1 =  \commandeApp\model\commande::where("nom_client", "=", "Aaron McGlynn")->with(["items"=> function ($q){
                                                                                                        $q->withTrashed();
                                                                                                        }])->get();

echo $commande1;