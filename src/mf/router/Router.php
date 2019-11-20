<?php
namespace mf\router;

use tweeterapp\control\TweeterController;

class Router extends  AbstractRouter{


    public function __construct(){
        parent::__construct();
    }



    /*
     * Méthode run : execute une route en fonction de la requête
     *    (la requête est récupérée dans l'atribut $http_req)
     *
     * Algorithme :
     *
     * - l'URL de la route est stockée dans l'attribut $path_info de
     *         $http_request
     *   Et si une route existe dans le tableau $route sous le nom $path_info
     *     - créer une instance du controleur de la route
     *     - exécuter la méthode de la route
     * - Sinon
     *     - exécuter la route par défaut :
     *        - créer une instance du controleur de la route par défault
     *        - exécuter la méthode de la route par défault
     *
     */
    public function run(){


        if(key_exists($this->http_req->path_info, self::$routes)){

            $controleur = self::$routes[$this->http_req->path_info][0];
            $methode = self::$routes[$this->http_req->path_info][1];

        }else{

            $url = self::$aliases['default'];
            $controleur = self::$routes[$url][0];
            $methode = self::$routes[$url][1];

        }
        $newControleur  = new $controleur();
        $newControleur->$methode();
    }



    /*
     * Méthode urlFor : retourne l'URL d'une route depuis son alias
     *
     * Paramètres :
     *
     * - $route_name (String) : alias de la route
     * - $param_list (Array) optionnel : la liste des paramètres si l'URL prend
     *          de paramètre GET. Chaque paramètre est représenté sous la forme
     *          d'un tableau avec 2 entrées : le nom du paramètre et sa valeur
     *
     * Algorthme:
     *
     * - Depuis le nom du scripte et l'URL stocké dans self::$routes construire
     *   l'URL complète
     * - Si $param_list n'est pas vide
     *      - Ajouter les paramètres GET a l'URL complète
     * - retourner l'URL
     *
     */

     public function urlFor($route_name, $param_list=[]){


         if(key_exists($route_name, self::$aliases)){

             $url = $this->http_req->script_name."/".self::$aliases[$route_name];
             if($param_list != null){
                 $url = $url."?";
                 foreach ($param_list as $unParam => $uneValeur){
                     $url = $url.$unParam."=".$uneValeur."&";

                 }


             }
             return $url;
         }


     }



    /*
   * Méthode addRoute : ajoute une route a la liste des routes
   *
   * Paramètres :
   *
   * - $name (String) : un nom pour la route
   * - $url (String)  : l'url de la route
   * - $ctrl (String) : le nom de la classe du Contrôleur
   * - $mth (String)  : le nom de la méthode qui réalise la fonctionalité
   *                     de la route
   *
   *
   * Algorithme :
   *
   * - Ajouter le tablau [ $ctrl, $mth ] au tableau self::$route
   *   sous la clé $url
   * - Ajouter la chaîne $url au tableau self::$aliases sous la clé $name
   *
   */
     public function addRoute($name, $url, $ctrl, $mth){

         self::$routes[$url] = [$ctrl, $mth];
         self::$aliases[$name] = $url;

    }


    /*
   * Méthode setDefaultRoute : fixe la route par défault
   *
   * Paramètres :
   *
   * - $url (String) : l'URL de la route par default
   *
   * Algorthme:
   *
   * - ajoute $url au tableau self::$aliases sous la clé 'default'
   *
   */

     public function setDefaultRoute($url){
        self::$aliases['default'] = $url;

     }

     public static function executeRoute ($unAlias){

          if(key_exists($unAlias, self::$aliases)){

              $url = self::$aliases[$unAlias];
              /*var_dump($url);*/

              if(key_exists($url, self::$routes)){
                  $controleur = self::$routes[$url][0];
                  $methode = self::$routes[$url][1];

              }

          }

            $newControleur  = new $controleur();
            $newControleur->$methode();

    }





}