<?php

namespace mf\utils;

class ClassLoader{

  private $prefix;



  public function __construct($prefix){

    $this->prefix = $prefix;

  }

  public function loadClass ($nomClass){

    $nomClass = str_replace("\\",DIRECTORY_SEPARATOR,$this->prefix.DIRECTORY_SEPARATOR.$nomClass.".php");

    //echo $nomClass;

    if(file_exists($nomClass)){



      // include_once(str_replace("\\","/",$prefix),".php");

    require_once $nomClass;

    }
  }

  public function register(){

    spl_autoload_register(array(__CLASS__, 'loadClass'));

  }

}
