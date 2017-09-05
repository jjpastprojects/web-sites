@extends('layout.message')

@section('content')
	{{ $messages->links() }}
	<table class="table">
		<tr>
			<td> {{ Lang::get('message.status') }} </td>
			<td> {{ Lang::get('message.subject') }} </td>
			<td> {{ Lang::get('message.body') }} </td>
		</tr>
		@foreach($messages as $message)
				<tr>
					<td><a href="{{ URL::route('ShowMessage',$message->id) }}"> {{ $message->status }}</a> </td>
					<td><a href="{{ URL::route('ShowMessage',$message->id) }}"> {{ $message->subject }} </a></td>
					<td><a href="{{ URL::route('ShowMessage',$message->id) }}"> {{ $message->body }} </a></td>
				</tr>
		@endforeach
	</table>
@stop