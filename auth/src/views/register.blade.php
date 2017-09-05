@extends('auth::layout.master')

@section('title')

@stop

@section('content')

@include('core::partials.errors')

<form method="post" class="form form-register">
<input
      type="hidden"
      name="_token"
      value="{{ csrf_token() }}"/
>
<input
    type="text"
    class="form-control"
    name="username"
    placeholder={{ trans('core::general.username')}}
    value="{{ old('username') }}"
>
<input
    type="email"
    class="form-control"
    name="email"
    placeholder={{ trans('core::general.email')}}
    value="{{ old('email') }}"
>
<input
    type="password"
    class="form-control"
    name="password"
    placeholder={{ trans('core::general.password')}}
    value="{{ old('password') }}"
>
<input
    type="password"
    class="form-control"
    name="password_confirmation"
    placeholder="{{ trans('core::general.password_confirmation')}}"
    value="{{ old('password_confirmation') }}"
>
<button
    class="btn btn-lg btn-primary btn-block"
    type="submit">{{ trans('auth::form.register') }}
</button>

</form>

@stop

