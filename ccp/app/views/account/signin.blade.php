@extends('layout.main')

@section('content')

<form class="form-horizontal" method="post" action="{{ URL::route('account-sign-in') }}">
    <div class="form-group">
        <label class="control-label col-sm-2">{{ Lang::get('general.email') }}: </label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="email"  {{ Input::old('email')? "value='".Input::old('email')."'":""  }} placeholder="{{ Lang::get('general.email') }}" >
        </div>
        @if($errors->has('email'))
            <div class="help-block col-sm-4">{{ $errors->first('email') }}</div>
        @else
            <div class="help-block col-sm-4"></div>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">{{ Lang::get('general.password') }}: </label>
        <div class="col-sm-6">
            <input class="form-control" type="password" name="password" placeholder="{{ Lang::get('general.password') }}" >
        </div>
        @if($errors->has('password'))
            <div class="col-sm-4 help-block">{{ $errors->first('password') }}</div>
        @else
            <div class="col-sm-4 help-block"></div>
        @endif
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 ">
            <div class="checkbox">
                <label for="remember"><input type="checkbox" name="remember"  id="remember"/>{{ Lang::get('general.remember-me') }}</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class=" col-sm-offset-2 col-sm-10">
            <input class="btn btn-default" type="submit"  value="{{ Lang::get('general.sign-in') }}"/>
        </div>
    </div>
    {{ Form::token()}}
</form>
@stop