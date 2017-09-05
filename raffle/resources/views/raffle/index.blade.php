@extends('layout.master')

@section('content')


<div class="row">
@foreach($raffles as $raffle)
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
       <img src="/uploads/images/{{ $raffle->img }}" alt="{{ $raffle->title }}">
      <div class="caption">
          <h3>{{ $raffle->title}}</h3>
          <p>{{ $raffle->rules }}</p>
          @if($raffle->isCompleted())

          <p class="btn btn-primary" role="button">you finished this raffle</p>
          @elseif($raffle->isOngoing())
    <p><a href="{{ route('participe.show', ['raffle_id' => $raffle->id]) }}" class="btn btn-primary" role="button">complete</a> </p>
          @else
   <p><a href="{{ route('participe.index', ['raffle_id' => $raffle->id]) }}" class="btn btn-primary" role="button">participe</a> </p>
          @endif
      </div>
    </div>
  </div>
@endforeach
</div>

@stop
