@extends('admin::layout.master')

@section('content')
@can('read-roles')

@can('create-roles')
<a
    href="{{route('admin::roles.create')}}"
    class="btn btn-primary pull-right"
>
    {{trans('admin::roles.new_role')}}
</a>
 @endcan

<table class="table">
    <thead>
        <tr>
            <th>{{ trans('admin::roles.name') }}</th>
            <th>{{ trans('admin::roles.order') }}</th>
            <th>{{ trans('admin::roles.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
            <tr>
                <td>
                    @can('edit-roles')
                    <a
                        href="{{ route('admin::roles.edit', ['id' => $role->id]) }}">
                        {{ $role->name }}
                    </a>
                    @else
                        {{ $role->name }}
                    @endcan
                </td>
                <td>{{ $role->order}}</td>
                <td>
                    @can('destroy-roles')
                        @include('admin::roles.partials.delete')
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    {{ trans('admin::roles.can_not_read_roles') }}
@endcan
@stop
