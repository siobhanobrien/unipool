<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Trip;
use Image;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
	/*
   * Display active posts of a particular user
   * 
   * @param int $id
   * @return view
   */
  public function user_trips($id)
  {
    //
    $trips = Trip::where('driver_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
    $title = User::find($id)->name;
    return view('/trips')->withTrips($trips)->withTitle($title);
  }
  /*
   * Display all of the posts of a particular user
   * 
   * @param Request $request
   * @return view
   */
  public function user_trips_all(Request $request)
  {
    //
    $user = $request->user();
    $trips = Trip::where('driver_id',$user->id)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withTrips($trips)->withTitle($title);
  }
  /*
   * Display draft posts of a currently active user
   * 
   * @param Request $request
   * @return view
   */
  public function user_trips_draft(Request $request)
  {
    //
    $user = $request->user();
    $trips = Trip::where('driver_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('trips')->withTrips($trips)->withTitle($title);
  }

  public function getContact() {
    return view('admin.contact');
  }

  public function postContact(Request $request) {
    $this->validate($request, [
      'email' => 'required|email',
      'subject' => 'min:3',
      'message' => 'min:10']);

    $data = array(
      'email' => $request->email,
      'subject' => $request->subject,
      'bodyMessage' => $request->message
      );

    Mail::send('emails.contact', $data, function($message) use ($data){
      $message->from($data['email']);
      $message->to('hello@devmarketer.io');
      $message->subject($data['subject']);
    });

    Session::flash('success', 'Your Email was Sent!');

    return redirect('/');
  }
  /**
   * profile for user
   */
  public function profile(Request $request, $id) 
  {
    $data['user'] = User::find($id);
    if (!$data['user'])
      return redirect('/');
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['driver'] = true;
    } else {
      $data['driver'] = null;
    }
    $data['comments_count'] = $data['user'] -> comments -> count();
    $data['trips_count'] = $data['user'] -> trips -> count();
    $data['trips_active_count'] = $data['user'] -> trips -> where('active', '1') -> count();
    $data['trips_draft_count'] = $data['trips_count'] - $data['trips_active_count'];
    $data['latest_trips'] = $data['user'] -> trips -> where('active', '1') -> take(5);
    $data['latest_comments'] = $data['user'] -> comments -> take(5);
    return view('admin.profile', $data);
    
  }    
  public function update_avatar(Request $request){
    if($request->hasFile('avatar')){
      $avatar = $request->file('avatar');
      $filename = time() . '.' . $avatar->getClientOriginalExtension();
      Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

      $user = Auth::user();
      $user->avatar = $filename;
      $user->save();


    }
    return view('change', array('user' => Auth::user()) );
  }
  public function change(){
    return view('change', array('user' => Auth::user()) );
  }
}
