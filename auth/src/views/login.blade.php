@extends('auth::layout.master')

@section('title')

@stop

@section('content')

@include('core::partials.errors')
<form method="post" class="form form-signin" role="form">

<h2 class="form-signin-heading">{{ trans('auth::form.signin') }}</h2>

<input
    type="hidden"
    name="_token"
    value="{{ csrf_token() }}"
>


<input
    type="email"
    class="form-control"
    placeholder={{ trans("core::general.email") }}
    class="form-control"
    name="email" value="{{ old('email') }}"
>

<input
    type="password"
    class="form-control"
    placeholder={{ trans("core::general.password") }}
    name="password" value="{{ old('password') }}"
>

<label class="checkbox" for="rememberme">
    <input type="checkbox" name="rememberme"  value="1">
    {{ trans('auth::form.rememberme') }}
</label>

<button
    class="btn btn-lg btn-primary btn-block"
    type="submit">{{ trans('auth::form.login') }}
</button>

<a
    href="{{ route('auth::reset.showEmail') }}"
    title="{{ trans('auth::form.forget_your_password') }}"
    class="pull-right"
>
{{ trans('auth::form.forget_your_password') }}
</a>

</form>
@stop

