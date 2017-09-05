@extends('admin::layout.master')

@section('content')
@can('edit-roles')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin::roles.edit_role') }}</div>
                <div class="panel-body">
                    @include('core::partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin::roles.update', ['id' => $role->id]) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('admin::roles.name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $role['name'] }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('admin::roles.order') }}</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="order" value="{{ $role['order'] }}">
                            </div>
                        </div>

                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('admin::roles.update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@stop
