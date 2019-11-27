<?php
namespace commandeApp\model;

class item extends \Illuminate\Database\Eloquent\Model
{

    protected $table      = 'item';  /* le nom de la table */
    protected $primaryKey = 'id';     /* le nom de la clé primaire */
    public    $timestamps = false;    /* si vrai la table doit contenir
                                      les deux colonnes updated_at,
                                      created_at */

    public function commandeItem(){

        return $this->belongsToMany("commandeApp\model\commande","item_commande","item_id","commande_id");
    }

}