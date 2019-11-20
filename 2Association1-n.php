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

$carte = \commandeApp\model\Carte::find(42);

echo $carte->commandes()->get();