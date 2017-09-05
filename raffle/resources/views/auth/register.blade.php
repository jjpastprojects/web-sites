@extends('layout.master')

@section('content')

<div class="container">
    <div class="login-form">
        <h2>Sign up</h2>
        <form class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('partials.errors')
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign Up</button>
                    <button type="button" class="btn btn-default" onClick="location.href='/login'">Already have an account?</button>
                </div>
            </div>
        </form>
    </div>
</div> <!-- /container -->

@stop
