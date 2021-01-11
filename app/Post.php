<?php

namespace App;

//use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Comment;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = [];

    public function user(){
      return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
     public function comments(){
         return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
     }

     public function getRouteKeyName()
     {
         return 'slug';
     }
     public function scopeLatest($query){
         return $query->orderBy('created_at', 'DESC');
     }
    
}
