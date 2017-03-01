<?php namespace App\Http\Controllers;
use App\Trip;
use App\Comment;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller {
  public function store(Request $request)
  {
    //on_post, from_user, body
    $input['from_user'] = $request->user()->id;
    $input['on_trip'] = $request->input('on_trip');
    $input['body'] = $request->input('body');
    $slug = $request->input('slug');
    Comment::create( $input );
    return redirect($slug)->with('message', 'Comment published');     
  }

  public function destroy(Request $request, $id)
  {
    //
    $comment = Comment::find($id);
    if($comment && ($comment->driver_id == $request->user()->id || $request->user()->is_admin()))
    {
      $comment->delete();
      $data['message'] = 'Comment deleted Successfully';
    }
    else 
    {
      $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
    }
    return redirect('/trips')->with($data);
  }

  }

 