@extends('layout.master')

@section('content')
    <h1>{{ $raffle->title }}</h1>
    <p>you already finish this raffle</p>
    <p> and you score is {{ $raffle->score() }}</p>
@stop
