<?php namespace App;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model {
  //comments table in database
  protected $guarded = [];
  // user who has commented
  public function driver()
  {
    return $this->belongsTo('App\User','from_user');
  }
  // returns post of any comment
  public function trip()
  {
    return $this->belongsTo('App\Trip','on_trip');
  }
}