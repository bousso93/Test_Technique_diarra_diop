<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offre;


class SecteurActivite extends Model
{
    //
    protected $table = 'secteur_activites';
    protected $guarded = [];


    public function offre(){
      return $this->belongsTo(Offre::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
