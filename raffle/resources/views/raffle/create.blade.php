@extends('layout.master')

@section('content')
<form method="post" action="{{ route('raffle.create') }}" enctype="multipart/form-data">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   @include('partials.errors')
   @include('partials.status')

   <div class="formbg row">
      <div class="form-group" role="form">


        <div class= "form-group">
            <label class="control-label col-md-1 col-md-offset-7 labelPadding" for="title">Raffle Title</label>
            <div class="col-md-3">
               <input type="text" class="form-control customPlaceholder" name="title" id="raftitle" placeholder="Enter Raffle Title">
               <p>{{$errors->first('title')}}</p>
            </div>
         </div>

         <div class= "form-group">
            <div class="col-md-4 col-md-offset-7">
               <label class="control-label col-md-offset-right-2" for="mechanics">Mechanics</label>
               <textarea class="form-control customPlaceholder makeTextarea noresize" rows="" name="mechanics" id="mechanic" placeholder="Enter Mechanics"></textarea>
               <p>{{$errors->first('mechanics')}}</p>
            </div>
         </div>

         <div class= "form-group">
            <div class="col-md-4 col-md-offset-7">
               <label class="control-label col-md-offset-right-2"  for="rules">Rules</label>
               <textarea class="form-control customPlaceholder makeTextarea noresize" rows="5" name="rules" id="rules" placeholder="Enter Rules"></textarea>
               <p>{{$errors->first('rules')}}</p>
            </div>
         </div>

         <div class= "form-group">
            <div class="col-md-4 col-md-offset-7">
               <label class="control-label col-md-offset-right-2" for="prize">Prize</label>
               <input type="text" class="form-control customPlaceholder" name="prize" id="prize" placeholder="Enter Prize">
               <p>{{$errors->first('prize')}}</p>
            </div>
         </div>

      </div>

      <div class ="row-fluid">

         <div class="col-md-3 col-md-offset-1">
            <label for="deadline">Deadline</label>
            <input type="text" class="form-control customPlaceholder datepicker" name="deadline" id="deadline" placeholder="yy-mm-dd">
            <p>{{$errors->first('deadline')}}</p>
         </div>

         <div class= "form-group col-md-3">
            <label for="image">Image File</label>
            <input type="file" class="form-control" name="image">
            <p>{{$errors->first('image')}}</p>
         </div>

         <div class= "form-group col-md-4">
            <label class="col-md-offset-4">add Questions</label>
            <button type="submit" class="btn btn-primary btn-block btnpadding">Next Step</button>
         </div>

      </div>
   </div>

</form>
@stop

@section("script")

<script type="text/javascript">

$(document).ready(function()
{
   $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

</script>

@stop
