<?php
namespace commandeApp\model;


class commande extends \Illuminate\Database\Eloquent\Model
{

    protected $table      = 'commande';  /* le nom de la table */
    protected $primaryKey = 'id';
    public $incrementing = false;/* le nom de la clé primaire */
    public    $timestamps = true;    /* si vrai la table doit contenir
                                      les deux colonnes updated_at,
                                      created_at */
    public function SaCarte(){

        return $this->belongsTo("commandeApp\model\Carte","carte_id");
    }

    public function items(){

        return $this->belongsToMany("commandeApp\model\item","item_commande","commande_id","item_id")->withPivot("quantite");
    }


    }