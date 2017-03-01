<?php

namespace App\Http\Controllers;
use App\Trip;
use App\User;
use App\Comment;
use Redirect;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
  {
    //fetch 5 trips from database which are active and latest
    $trips = Trip::where('active',1)->orderBy('created_at','desc')->paginate(6);
    //page heading
    $title = 'Latest Trips';
    //return home.blade.php template from resources/views folder
    return view('trips')->withTrips($trips)->withTitle($title);
  }

	public function create(Request $request)
  {
    // if user can post i.e. user is admin or author
    if($request->user()->can_post())
    {
      return view('/trips.create');
    }    
    else 
    {
      return redirect('/home')->withErrors('You have not sufficient permissions for writing post');
    }
  }

  public function store(Request $request)
  
  {
    $this->validate($request, [
        'title' => 'required|unique:trips|max:255',
       
    ]);

    

    $trip = new Trip();
    $trip->title = $request->get('title');
    $trip->to = $request->get('to');
    $trip->from = $request->get('from');
    $trip->date = $request->get('date');
    $trip->time = $request->get('time');
    $trip->price = $request->get('price');
    $trip->seat = $request->get('seat');
    $trip->body = $request->get('body');
    $trip->slug = str_slug($trip->title);
    $trip->driver_id = $request->user()->id;
    
    if($request->has('save'))
    {
      $trip->active = 0;
      $message = 'Trip saved successfully';            
    }            
    else 
    {
      $trip->active = 1;
      $message = 'Trip published successfully';
    }
    $trip->save();
    return redirect('edit/'.$trip->slug)->withMessage($message);
    
    

  }


  public function show($slug)
  {
    $trip = Trip::where('slug',$slug)->first();
    if(!$trip)
    {
       return redirect('/trips')->withErrors('requested page not found');
    }
    $comments = $trip->comments;
    return view('trips.show')->withTrip($trip)->withComments($comments);
  }

  public function edit(Request $request,$slug)
  {
    $trip = Trip::where('slug',$slug)->first();
    if($trip && ($request->user()->id == $trip->driver_id || $request->user()->is_admin()))
      return view('trips.edit')->with('trip',$trip);
    return redirect('/home')->withErrors('you have not sufficient permissions');
  }

  public function update(Request $request)
  {
    //
    $trip_id = $request->input('trip_id');
    $trip = Trip::find($trip_id);
    if($trip && ($trip->driver_id == $request->user()->id || $request->user()->is_admin()))
    {
      $title = $request->input('title');
      $slug = str_slug($title);
      $duplicate = Trip::where('slug',$slug)->first();
      if($duplicate)
      {
        if($duplicate->id != $trip_id)
        {
          return redirect('edit/'.$trip->slug)->withErrors('Title already exists.')->withInput();
        }
        else 
        {
          $trip->slug = $slug;
        }
      }
      $trip->title = $title;
      $trip->to = $request->input('to');
      $trip->from = $request->input('from');
      $trip->date = $request->input('date');
      $trip->time = $request->input('time');
      $trip->price = $request->input('price');
      $trip->seat = $request->input('seat');
      $trip->body = $request->input('body');
      if($request->has('save'))
      {
        $trip->active = 0;
        $message = 'Trip saved successfully';
        $landing = 'edit/'.$trip->slug;
      }            
      else {
        $trip->active = 1;
        $message = 'Trip updated successfully';
        $landing = $trip->slug;
      }
      $trip->save();
           return redirect($landing)->withMessage($message);
    }
    else
    {
      return redirect('/')->withErrors('you have not sufficient permissions');
    }
  }

  public function destroy(Request $request, $id)
  {
    //
    $trip = Trip::find($id);
    if($trip && ($trip->driver_id == $request->user()->id || $request->user()->is_admin()))
    {
      $trip->delete();
      $data['message'] = 'Trip deleted Successfully';
    }
    else 
    {
      $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
    }
    return redirect('/trips')->with($data);
  }

}
