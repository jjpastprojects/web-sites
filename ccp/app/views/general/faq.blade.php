@extends('layout.main')

@section('content')
	<h1> {{ Lang::get('general.faq') }} </h1>
	<div>
		@foreach($faqs as $Q => $A)
			<div>
				<h2> {{ $Q }} </h2>
				<p> {{ $A }} </p>
			</div>
		@endforeach
	</div>
@endsection