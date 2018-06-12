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
    
    public function favorite($micropostId)
{
    $exist = $this->is_favoriting($micropostId);
    $its_me = $this->id == $micropostId;

    if ($exist || $its_me) {
        return false;
    } else {
        // follow if not following
        $this->favoritings()->attach($micropostId);
        return true;
    }
}

public function unfollow($userId)
{
    // confirming if already following
    $exist = $this->is_following($userId);
    // confirming that it is not you
    $its_me = $this->id == $userId;


    if ($exist && !$its_me) {
        // stop following if following
        $this->followings()->detach($userId);
        return true;
    } else {
        // do nothing if not following
        return false;
    }
}


public function is_following($userId) {
    return $this->followings()->where('follow_id', $userId)->exists();
}
}
