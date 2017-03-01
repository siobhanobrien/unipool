@extends('layouts.trips')
@section('title')
Add New Trip 
@endsection
@section('content')
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />


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
                            <h1>Create a new trip below. Just enter the details and simply publish your trip!</h1>
       
                  
          </div>
      </div>
  </div>

  </div>
</div>
<br>
<br>
<div class="col-md-7">
<form action="/new-trip" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <div class="form-group">
    <input required="required" value="{{ old('title') }}" placeholder="Trip Title: Leaving From - Going To" type="text" max="40" name = "title" class="form-control" />
  </div>

  <div class="form-group">
    <input required="required" value="{{ old('to') }}" placeholder="To" type="text" max="40" name = "to" class="form-control" />
  </div>

  <div class="form-group">
    <input required="required" value="{{ old('from') }}" placeholder="From" type="text" max="40" name = "from" class="form-control" />
  </div>

  <div class="form-group">
    <input required="required" value="{{ old('date') }}" placeholder="DD/MM/YY" type="date" name = "date" class="form-control" />
  </div>

<div class="form-group">
    <input required="required" value="{{ old('time') }}" placeholder="Time 00:00" type="time" name = "time" class="form-control" />
  </div>

  <div class="form-group">
    <input required="required" value="{{ old('price') }}" placeholder="Price €" type="number" step="0.01"  min="0" name = "price" class="form-control" />
  </div>

  <div class="form-group">
    <input required="required" value="{{ old('seat') }}" placeholder="Seats Available" type="number" min="0" name = "seat" class="form-control" />
  </div>



  <div class="form-group">
    <textarea name='body' class="form-control">{{ old('body') }}</textarea>
  </div>

  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
</form>

</div>
@endsection