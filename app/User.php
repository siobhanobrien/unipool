<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;


class User extends Authenticatable
{
    use Notifiable, Searchable;

      /**
       * The database table used by the model.
       *
       * @var string
       */
      protected $table = 'users';
      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = ['name', 'email', 'password'];
      /**
       * The attributes excluded from the model's JSON form.
       *
       * @var array
       */
      protected $hidden = ['password', 'remember_token'];
      // user has many posts
      public function trips()
      {
        return $this->hasMany('App\Trip','driver_id');
      }

      // user has many comments
      public function comments()
      {
        return $this->hasMany('App\Comment','from_user');
      }

      public function can_post()
      {
        $role = $this->role;
        if($role == 'driver' || $role == 'admin')
        {
          return true;
        }
        return false;
      }

      public function is_admin()
      {
        $role = $this->role;
        if($role == 'admin')
        {
          return true;
        }
        return false;
      }

      public function conversations()
    {

        return $this->belongsToMany(Conversation::class)->whereNull('parent_id')->orderBy('last_reply', 'desc');
    }

    //Checks if user is in certain conversation
    public function isInConversation(Conversation $conversation)
    {
        return $this->conversations->contains($conversation);
    }

    //Adding avatar using gravatar - just messing around could change in future
    public function avatar($size = 45)
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=mm';
    }
}
