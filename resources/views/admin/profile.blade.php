@extends('layouts.app')
@section('title')
{{ $user->name }}
@endsection
@section('content')


<header>
<div class="profile">
        <div class="container profile-head">
                    <div class="profile-content col-md-5">
                            <img src="/uploads/avatars/{{$user->avatar}}" style="width:250px; height:250px; border-radius:50%;">
                              <h1>{{ $user->name }}</h1>
                              <h2>Joined on {{$user->created_at->format('M d,Y') }}</h2>
                             <!--
                              <form enctype="multipart/form-data" action="/profile" method="POST">
                                <label>Update Profile Image</label>
                                <input type="file" name="avatar">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="pull-right btn btn-sm btn-primary">
                              </form>
                             -->
      
                      </div><!-- PROFILE CONTENT DIV -->
          </div>
      
         

</header>

<div class="latest_trips">
        <div class="col-md-4 blue" id="trip_column">
        <div class="image-content">
              <a href="{{ url('/user/'.$user->id.'/trips')}}" class="btn btn-outline btn-xl page-scroll">Trip Details</a>
                <br>
                <br>
                <p>Total Trips - {{$trips_count}}</p>
                @if($driver && $trips_count) 
                @endif     
                <p>Total Comments - {{$comments_count}}</p>
        </div>
      </div>

<div class="col-md-4 pink" id="trip_column">
        <div class="image-content-pink">
              <a href="{{ url('/user/'.$user->id.'/trips')}}" class="btn btn-outline btn-xl page-scroll">Latest Trips</a>
                <br>
                <br>
          @if(!empty($latest_trips[0]))
          @foreach($latest_trips as $latest_trip)
        
              <p><a href="{{ url('/'.$latest_trip->slug) }}">{{ $latest_trip->title }} -</a>
              <span class="well-sm">On {{ $latest_trip->created_at->format('M d,Y') }}</span></p>
          @endforeach
          @else
          <p>{{ $user->name }} has not posted a trip yet!</p>
          @endif

        </div>
</div>
          

 <div class="col-md-4 navy" id="trip_column">
        <div class="image-content-navy">
        <a href="" class="btn btn-outline btn-xl page-scroll">{{ $user->name }}'s Comments</a>
          <br>
          <br>
          @if(!empty($latest_comments[0]))
            @foreach($latest_comments as $latest_comment)

                <p>{{ $latest_comment->body }} - On {{ $latest_comment->created_at->format('M d,Y') }}</p>
            @endforeach
            @else
              <p>No comments have been posted.</p>
            </div>
            @endif
         </div>
      </div>
</div><!-- END PROFILE DIV -->


@endsection

