@extends('layouts.app')

@section('content')

<div class="edit">
        <div class="container">
                <div class="col-sm-7">
                    <div class="edit-content">
                    <br>
                    <br>
                	<h2>Change your profile image {{ $user->name}}</h2>
                 </div>
  </div>

  </div>
</div>

<div class="container">
	<div class="row">
	<div class="col-md-10 col-md-offset-1">
	<br>
	<br>
	<img src="/uploads/avatars/{{$user->avatar}}" >
                              <h1>{{ $user->name }}</h1>
                             <form enctype="multipart/form-data" action="/change" method="POST">
                                <label>Update Profile Image</label>
                                <input type="file" name="avatar">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-sm btn-primary">
                              </form>
                          
		</div>
</div>
</div>
@endsection
