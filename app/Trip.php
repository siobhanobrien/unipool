<?php 

namespace App;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
// instance of Posts class will refer to posts table in database
class Trip extends Model {

    
    use Searchable;
    
    protected $fillable = ['title'];

    public function searchableAs()
    {
      return 'trips';
    }

  
  //restricts columns from modifying
  protected $guarded = [];
  // posts has many comments
  // returns all comments on that post
  public function comments()
  {
    return $this->hasMany('App\Comment','on_trip');
  }
  // returns the instance of the user who is author of that post
  public function driver()
  {
    return $this->belongsTo('App\User','driver_id');
  }
  
}