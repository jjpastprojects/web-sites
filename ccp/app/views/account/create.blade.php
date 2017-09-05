@extends('layout.main')

@section('content')
    
<form class="form-horizontal" action="{{ URL::route('account-create-post') }}" method='post'>
    <div class="form-group">
        <label class="control-label col-sm-2">{{ Lang::get('general.email') }} : </label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="email"{{ (Input::old('email'))? 'value='.e(Input::old('email')):'' }} placeholder="{{ Lang::get('general.email') }}">
        </div>
        @if($errors->has('email'))
           <div class="help-block col-sm-4">{{ $errors->first('email') }}</div>
        @else
           <div class="help-block col-sm-4"></div>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">{{ Lang::get('general.username') }}: </label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="username"{{ (Input::old('username'))? 'value='.e(Input::old('username')):''  }} placeholder="{{ Lang::get('general.username') }}">
        </div>
        @if($errors->has('username'))
           <div class="help-block col-sm-4">{{ $errors->first('username') }}</div>
        @else
           <div class="help-block col-sm-4"></div>
        @endif
    </div>
    <div class="form-group">
       <label class="control-label col-sm-2">{{ Lang::get('general.password') }}: </label>
       <div class="col-sm-6">
            <input class="form-control" type="password" name="password" placeholder="{{ Lang::get('general.password') }}">
        </div>
        @if($errors->has('password'))
           <div class="help-block col-sm-4">{{ $errors->first('password') }}</div>
        @else
           <div class="help-block col-sm-4"></div>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">{{ Lang::get('general.password-again') }}: </label>
        <div class="col-sm-6">
            <input class="form-control" type="password" name="password_again" placeholder="{{ Lang::get('general.password-again') }}">
        </div>
        @if($errors->has('password_again'))
           <div class="help-block col-sm-4">{{ $errors->first('password_again') }}</div>
        @else
           <div class="help-block col-sm-4"></div>
        @endif
    </div>
    {{ Form::token()}}
    <div class="form-group">
        <div class=" col-sm-offset-2 col-sm-10">
            <input class="btn btn-default" type='submit' value="{{ Lang::get('general.account-submit') }}"/>
        </div>
    </div>
    
</form>
@endsection