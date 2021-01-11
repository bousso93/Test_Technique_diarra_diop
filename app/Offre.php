<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SecteurActivite;

class Offre extends Model
{
    //
    protected $table = 'offres';
    protected $guarded = [];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function sector(){
      return $this->belongsTo(SecteurActivite::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
