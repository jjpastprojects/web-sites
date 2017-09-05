@extends('layout.main')

@section('content')
	<div>
		<form method="post" action="{{ URL::route('contact_me') }}" role="form" class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-2">	
					<label class="control-label">{{ Lang::get('general.subject') }}:</label>
				</div>
				<div class='col-sm-3'>
					<input class="from-control" type="text" name="subject" placeholder="subject" {{ Input::old('subject')? "value='".Input::old('subject')."'":"" }} >
				</div>
				@if($errors->has('subject'))
					<div class="col-sm-3 help-block">
						{{ $errors->first('subject') }}
					</div>
				@endif
			</div>

			<div class="form-group">
				<div class="col-sm-2">
					<label>{{ Lang::get('general.message') }}:</label>
				</div>
				<div class="col-sm-8">
					<textarea class="form-control" name='message' >
						{{ Input::old('message') }}
					</textarea>
				</div>
				@if($errors->has('message'))
					<div class="col-sm-2"> 
						{{ $errors->first('message') }}
					</div>
				@endif
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2">
					<input class="btn btn-default" type="submit" value="{{ Lang::get('general.submit') }}" >
				</div>
			</div>
			{{ Form::token() }}		
		</form>
	</div>
@endsection