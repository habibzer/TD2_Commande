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



$requet1 = \commandeApp\model\Carte::where("mail_proprietaire", "LIKE","%Aaron.McGlynn%")->with(["commandes" => function ($q){
                                                                                                $q->where("etat",">",0)->get();
                                                                                                }])->get();

/*echo $requet1;*/

/*Question2*/

$q2 = \commandeApp\model\commande::where("carte_id","=",28)->where("etat", ">=", 0)->where("montant",">",20)->get();


/*echo $q2;*/

/*Queston 3*/

$q3 = \commandeApp\model\commande::with(["items" => function($q){
                                                        $q->where('tarif',">",5.0)->get();
                                                        }])
                                                        ->where("id","=", "9f1c3241-958a-4d35-a8c9-19eef6a4fab3")->get();


/*echo $q3;*/

/*Question 4*/

/*$q4 = \commandeApp\model\Carte::with(["commandes" => function($q){
                                                        $q->where(count($q), ">", 8)->get();
                                                        }])->get();*/

$q4 = \commandeApp\model\Carte::has("commandes",">",8)->get();

    /*echo $q4;*/

/*Question 5*/

$q5 = \commandeApp\model\Carte::whereHas("commandes", function($q){
                                                        $q->has("items",">",3);
                                                    })->get();

/*echo $q5;*/

/*question 6*/

$q6 = \commandeApp\model\commande::whereHas("items", function($q){
                                                        $q->where("id","=",2);
})->get();

/*echo $q6;*/

/*question 7 */

$q7 = \commandeApp\model\Carte::whereHas("commandes", function($q){
                                                        $q->where("montant",">",30.0);
})->get();

/*echo $q7;*/

/*Question 8*/

$q8 = \commandeApp\model\commande::has("saCarte")->has("items",">",3)->get();

/*echo $q8;*/