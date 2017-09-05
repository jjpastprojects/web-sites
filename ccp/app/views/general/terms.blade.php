@extends('layout.main')

@section('content')
	<h1> {{ Lang::get('general.terms') }} </h1>
	@foreach($terms as $term)
		<div class="term row"><p> {{ $term }} </p></div>
	@endforeach
@endsection