<?php
namespace commandeApp\model;

class paiement extends \Illuminate\Database\Eloquent\Model
{
    protected $table      = 'paiement';  /* le nom de la table */
    protected $primaryKey = 'ref_paiement';     /* le nom de la clé primaire */
    public    $timestamps = false;    /* si vrai la table doit contenir
                                      les deux colonnes updated_at,
                                      created_at */
}