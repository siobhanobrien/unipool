@extends('layouts.trips')
@section('title')

@endsection

@section('content')

<div class="trip">
        <div class="container">
                <div class="col-sm-7">
                    <div class="head-content">
                        <div class="head-content-inner">
                            <h1>Welcome to the trips section. Pick a trip, message the driver and you're good to go!</h1>
       
                  <form action="/search" method="get"> 
                          <div class="search my-nice-button">
                          <span class="fa fa-search"></span>
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
<div class="trip_homepage">
	@if ($trips->count())
	@foreach ($trips as $trip)
	<div class="col-md-4 white" id="trip_size">
    <div class="trip-content">
	<a href="{{ url('/'.$trip->slug) }}" class="btn btn-outline-trip btn-xl page-scroll"> {{ $trip->title }}</a>
	@if(!Auth::guest() && ($trip->driver_id == Auth::user()->id || Auth::user()->is_admin()))
          @if($trip->active == '1')
         <p><a href="{{ url('edit/'.$trip->slug)}}" class="btn btn-outline-edit btn-xl page-scroll">Edit Trip</a></p>
          @else

          <p><a href="{{ url('edit/'.$trip->slug)}}" class="btn btn-outline-edit btn-xl page-scroll">Edit Draft</a></p>
          @endif
        @endif
        
      </h3>
      <p>{{ $trip->created_at->format('M d,Y') }} By <a href="{{ url('/user/'.$trip->driver_id)}}">{{ $trip->driver->name }}</a></p>
    
    <br>
  
      <article>
      <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $trip->from }} <i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $trip->to }} </p>
      <p> <i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $trip->date }} <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $trip->time }}</p>
      <p><i class="fa fa-credit-card" aria-hidden="true"></i> €{{ $trip->price }} <i class="fa fa-users" aria-hidden="true"></i> {{ $trip->seat }}</p>
      {!! str_limit($trip->body, $limit = 1500, $end = '....... <a href='.url("/".$trip->slug).'>Read More</a>') !!}
      </article>
      <hr>
</div>
 </div>
 
	@endforeach
	
	@endif
</div>
@endsection