@extends('admin::layout.master')

@section('content')
 {!! $users->links() !!}

@can('create-users')
<a
    href="{{route('admin::users.create')}}"
    class="btn btn-primary pull-right"
>
    {{trans('admin::create-user')}}
</a>
@endcan

    {!! $users->appends(['orderby' => $orderby, 'direction' => $direction])->links() !!}

<table class="table">
    <thead>
    <tr>

        <th>
            <a
                href="{{ routeWithOrderBy('admin::users.index', 'id', $direction) }}">
                {{ trans('admin::users.id') }}
            </a>
        </th>

        <th>
            <a
                href="{{ routeWithOrderBy('admin::users.index', 'username', $direction) }}">
                {{ trans('admin::users.username') }}
            </a>
        </th>

        <th>
                {{ trans('admin::users.role') }}
        </th>

    </tr>
    </thead>
    @foreach($users as $user)
    <tbody>
    <tr>
        <td>{{ $user->id}}</td>
        @can('read-users')
        <td><a href="{{ route('admin::users.show', ['username' => $user['username']]) }}">{{ $user['username'] }}</a></td>
        @else
        <td>{{ $user['username'] }}</td>
        @endcan
        <td>
            @foreach($user->roles as $role)
                {{ $role->name }}
            @endforeach
        </td>
    </tr>
    </tbody>
    @endforeach
</table>
{!! $users->appends(['orderby' => $orderby, 'direction' => $direction])->links() !!}
@stop

