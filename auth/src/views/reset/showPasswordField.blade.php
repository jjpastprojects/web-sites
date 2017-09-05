@extends('auth::layout.master')

@section('title')

@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Your Password</div>
                    <div class="panel-body">
                        @include('core::partials.errors')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth::post_reset_password') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">password confirmation</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                </div>

                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

