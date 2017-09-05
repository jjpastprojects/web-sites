@extends('layout.message')

@section('content')
	<div>
		<h1> {{ $message->subject  }}</h1>
		<p>{{ $message->body }} </p>
	</div>
@stop