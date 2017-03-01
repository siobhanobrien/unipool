@extends('layouts.trips')
@section('title')
Edit Trip
@endsection
@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
  tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
    });
</script>

<div class="edit">
        <div class="container">
                <div class="col-sm-7">
                    <div class="edit-content">
                        <div class="edit-content-inner">
                            <h1><i class="fa fa-file" aria-hidden="true"></i>  EDIT TRIP</h1>
       
                  
          </div>
      </div>
  </div>

  </div>
</div>

<br>
<br>
<div class="col-sm-7">
<form method="post" action='{{ url("/update") }}'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="trip_id" value="{{ $trip->id }}{{ old('trip_id') }}">
  <div class="form-group">
    <input required="required" placeholder="Trip Title" type="text" min="5" max="40" name = "title" class="form-control" value="@if(!old('title')){{$trip->title}}@endif{{ old('title') }}"/>
  </div>
  <div class="form-group">
    <input required="required" placeholder="To" type="text" max="40" name = "to" class="form-control" value="@if(!old('to')){{$trip->to}}@endif{{ old('to') }}"/>
  </div>
  <div class="form-group">
    <input required="required" placeholder="From" type="text" max="40" name = "from" class="form-control" value="@if(!old('from')){{$trip->from}}@endif{{ old('from') }}"/>
  </div>
  <div class="form-group">
    <input required="required" placeholder="Date YY/MM/DD" type="date" name = "date" class="form-control" value="@if(!old('date')){{$trip->date}}@endif{{ old('date') }}"/>
  </div>
  <div class="form-group">
    <input required="required" placeholder="Time 00:00" type="time" name = "time" class="form-control" value="@if(!old('time')){{$trip->time}}@endif{{ old('time') }}"/>
  </div>
  <div class="form-group">
    <input required="required" placeholder="Price €" type="number" step="0.01" min="0" name = "price" class="form-control" value="@if(!old('price')){{$trip->price}}@endif{{ old('price') }}"/>
  </div>
  <div class="form-group">
    <input required="required" placeholder="Price €" type="number" min="0" name = "seat" class="form-control" value="@if(!old('seat')){{$trip->seat}}@endif{{ old('seat') }}"/>
  </div>

  <div class="form-group">
    <textarea name='body'class="form-control">
      @if(!old('body'))
      {!! $trip->body !!}
      @endif
      {!! old('body') !!}
    </textarea>
  </div>
  @if($trip->active == '1')
  <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
  @else
  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
  @endif

  <a href="{{  url('delete/'.$trip->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
</form>
</div>

@endsection