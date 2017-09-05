@extends('admin::layout.master')

@section('content')
@can('create-users')
<form action="{{ route('admin::users.store') }}" method="post" class="form">
{{ csrf_field() }}
<input
    type="text"
    class="form-control"
    name="username"
    placeholder="{{ trans('core::general.username')}}"
    value="{{ old('username') }}"
>
<input
    type="email"
    class="form-control"
    name="email"
    placeholder="{{ trans('core::general.email')}}"
    value="{{ old('email') }}"
>
<input
    type="password"
    class="form-control"
    name="password"
    placeholder="{{ trans('core::general.password')}}"
    value="{{ old('password') }}"
>

<button
    class="btn btn-lg btn-primary btn-block"
    type="submit">{{ trans('admin::create-user') }}
</button>

</form>
@else

<p> {{ trans('admin::users.can_not_create_users') }}</p>

@endcan

@stop
