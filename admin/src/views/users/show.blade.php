@extends('admin::layout.master')

@section('title')

@stop

@section('content')

@can('read-users')
<table class="table">
    <thead>
        <tr>
            <th>{{ trans('admin::users.key') }}</th>
            <th>{{ trans('admin::users.value') }}</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{{ trans("admin::users.username")}}</td>
                <td>{{ $user->username}}</td>
            </tr>
            <tr>
                <td>{{ trans("admin::users.email") }}</td>
                <td>{{ $user->email }}</td>
            </tr>

            @if(count($user->profile))
            @foreach($user->profile->toArray() as $key => $value)
                <tr>
                    <td>{{ trans("admin::users.$key")}}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
            @endif

    </tbody>
</table>

@if(count($user->roles))
    <h1>{{ trans('admin::users.roles') }}</h1>
    @foreach($user->roles as $role)
    <form action="{{ route('admin::roles.users.destroy', ['role' => $role->id, 'user' => $user->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="hidden" name="user" value="{{$user->id}}">
            <h4>
                {{ $role->name }}
                <input type="submit"  value="X">
            </h4>
        </form>
    @endforeach
@endif

@if(count(auth()->user()->getRolesFor($user)))
    <form action="{{ route('admin::roles.users.store', $user->id) }}" method="post">
         {{ csrf_field() }}
         <input type="hidden" name="user" value="{{$user->id}}">
        <select name="role" >
            @foreach(auth()->user()->getRolesFor($user) as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="{{ trans('core::general.add') }}">
    </form>
@endif

@can('destory-user', $user)
    <form action="{{ route('admin::users.destroy', ['username' => $user->username]) }}" method="post">

         {{ csrf_field() }}

         {{ method_field('DELETE') }}

        <button>{{ trans('core::general.delete') }}</button>
    </form>
@endcan
@else
<p>{{ trans('admin::users.can_not_read_users') }}</p>
@endcan

@stop

