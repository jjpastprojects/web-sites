@extends('acp/layout/main')

@section('title')

@stop

@section('content')
   <h1>{{ Lang::get('ccp.buys') }}</h1>
    @foreach($buys as $buy)
    @endforeach
@stop

