<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function favoritings()
    {
        return $this->belongsToMany(Micropost::class, 'micropost_favorite', 'favorite_id', 'favorited_id')->withTimestamps();
    }

    public function followeds()
    {
        return $this->belongsToMany(Micropost::class, 'micropost_favorite', 'favorited_id', 'favorite_id')->withTimestamps();
    }
}
