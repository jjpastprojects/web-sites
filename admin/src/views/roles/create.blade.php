@extends('admin::layout.master')

@section('content')
@can('create-roles')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin::roles.create_role') }}</div>
                <div class="panel-body">
                    @include('core::partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin::roles.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('admin::roles.name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('admin::roles.order') }}</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="order" value="{{ old('order') }}">
                            </div>
                        </div>

                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('admin::roles.create_role') }}
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
