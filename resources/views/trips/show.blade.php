@extends('layouts.trips')
@section('title')
  @if($trip)
    {{ $trip->title }}
    @if(!Auth::guest() && ($trip->driver_id == Auth::user()->id || Auth::user()->is_admin()))
      <button class="btn" style="float: right"><a href="{{ url('edit/'.$trip->slug)}}">Edit Trip</a></button>
    @endif
  @else
    Page does not exist
  @endif
@endsection
@section('title-meta')


<div class="trip">
        <div class="container">
                <div class="col-sm-7">
                    <div class="head-content">
                        <div class="head-content-inner">
                            <h1>Welcome to the trips section. Pick a trip, message the driver and you're good to go!</h1>
       
                  <form action="/search" method="get"> 
                          <div class="search my-nice-button">
                          <span class="fa-stack fa-lg">
                          <i class="fa fa-search" aria-hidden="true"></i></span>
                      <input type="text" name="q" id="q" class="form-control" placeholder="Search a Trip Location">
                          </div>
                </form>
          </div>
      </div>
  </div>

                    <div class="col-sm-5 searchbar-content">
                    <img src="img/test.gif" class="img-responsive" alt="">
                    </div>
    </div>
</div>

<div class="show_homepage">
<div class="col-md-4 white" id="show_size">
    <div class="show-content">
<a href="{{ url('/'.$trip->slug) }}" class="btn btn-outline-trip btn-xl page-scroll"> {{ $trip->title }}</a>
@if(!Auth::guest() && ($trip->driver_id == Auth::user()->id || Auth::user()->is_admin()))
          @if($trip->active == '1')
         <p><a href="{{ url('edit/'.$trip->slug)}}" class="btn btn-outline-edit btn-xl page-scroll">Edit Trip</a></p>
          
          @endif
           @endif

<p>{{ $trip->created_at->format('M d,Y') }} By <a href="{{ url('/user/'.$trip->driver_id)}}">{{ $trip->driver->name }}</a></p>
<br>
@endsection
@section('content')
@if($trip)

  <article>
      <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $trip->from }} <i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $trip->to }} </p>
      <p> <i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $trip->date }} <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $trip->time }}</p>
      <p><i class="fa fa-credit-card" aria-hidden="true"></i> €{{ $trip->price }} <i class="fa fa-users" aria-hidden="true"></i> {{ $trip->seat }}</p>
      {!! str_limit($trip->body, $limit = 1500, $end = '....... <a href='.url("/".$trip->slug).'>Read More</a>') !!}
      </article>   
  <hr>
  </div>
  </div>
  </div>
  <br>
  

    <div class="panel-body">
    <div class="col-md-7">
           <div>
          <h2>Leave a comment</h2>
          </div>
      
      <form method="post" action="/comment/add">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="on_trip" value="{{ $trip->id }}">
        <input type="hidden" name="slug" value="{{ $trip->slug }}">
        <div class="form-group">
          <textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
        </div>
        <input type="submit" name='trip_comment' class="btn btn-success" value = "Post Comment"/>
      </form>
    </div>

    </div>

  <div>
    @if($comments)
    <ul style="list-style: none; padding: 0">
      @foreach($comments as $comment)
        <li class="panel-body">
          <div class="list-group">
            <div class="list-group-item">
              <a href="{{ url('/user/'.$comment->from_user)}}"> <h3>{{ $comment->driver->name }}</h3></a>
            <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}  
           @if(!Auth::guest() && ($comment->from_user == Auth::user()->id || Auth::user()->is_admin()))
          | <a href="{{ route('comment.delete', ['id' => $comment->id]) }}">Delete</a>
            @endif()
            </div>
            <div class="list-group-item">
              <p>{{ $comment->body }}</p>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    @endif
  </div>
@else
404 error
@endif
@endsection