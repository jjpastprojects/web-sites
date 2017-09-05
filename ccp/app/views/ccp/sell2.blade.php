@extends('layout.main')

@section('content')

<div>
	<form class="form-horizontal" method="post" action="{{ URL::route('sell') }}">
		<div class="form-group">
			<label class="control-label col-sm-3">{{ Lang::get('ccp.paypal') }}</label>
			<div>
				<input type="email" name="paypal" {{ (Input::old('paypal'))? 'value='.e(Input::old('paypal')):'' }}  >
			</div>
			@if($errors->has('paypal'))
	           <div class="help-block col-sm-4">{{ $errors->first('paypal') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">{{ Lang::get('ccp.amount') }}</label>
			<div>
				<input type="number" name="amount"  {{ (Input::old('amount'))? 'value='.e(Input::old('amount')):'' }}>
			</div>
			@if($errors->has('amount'))
	           <div class="help-block col-sm-4">{{ $errors->first('amount') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-3">{{ Lang::get('ccp.ccp') }}</label>
			<div>
				<input type="number" name="ccp"  {{ (Input::old('ccp'))? 'value='.e(Input::old('ccp')):'' }}>
			</div>
			@if($errors->has('ccp'))
	           <div class="help-block col-sm-4">{{ $errors->first('ccp') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">{{ Lang::get('general.first_name') }}</label>
			<div>
				<input type="text" name="first_name" {{ (Input::old('first_name'))? 'value='.e(Input::old('first_name')):'' }}  >
			</div>
			@if($errors->has('first_name'))
	           <div class="help-block col-sm-4">{{ $errors->first('first_name') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">{{ Lang::get('general.last_name') }}</label>
			<div>
				<input type="text" name="last_name"  {{ (Input::old('last_name'))? 'value='.e(Input::old('last_name')):'' }}>
			</div>
			@if($errors->has('last_name'))
	           <div class="help-block col-sm-4">{{ $errors->first('last_name') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>

		<div class="form-group">
			<label class="control-label col-sm-3">{{ Lang::get('general.email') }}({{ Lang::get('general.optional') }})</label>
			<div>
				<input type="email" name="email"  {{ (Input::old('email'))? 'value='.e(Input::old('email')):'' }} >
			</div>
			@if($errors->has('email'))
	           <div class="help-block col-sm-4">{{ $errors->first('email') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">{{ Lang::get('general.phone_number') }}({{ Lang::get('general.optional') }})</label>
			<div>
				<input type="number" name="phone_number" {{ (Input::old('phone_number'))? 'value='.e(Input::old('phone_number')):'' }}  >
			</div>
			@if($errors->has('phone_number'))
	           <div class="help-block col-sm-4">{{ $errors->first('phone_number') }}</div>
	        @else
	           <div class="help-block col-sm-4"></div>
	        @endif
		</div>	
		<div class="form-group">
        <div class=" col-sm-offset-4 col-sm-10">
            <input class="btn btn-success " type='submit' value="{{ Lang::get('ccp.sell_submit') }}"/>
        </div>
    </div>
	</form>
</div>

@endsection