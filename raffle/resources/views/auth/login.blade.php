@extends('layout.master')

@section('content')
    <div class="container">
        <div class="login-form">
            <h2>Sign in</h2>
            <form class="form-horizontal" method="post">
                @include('partials.errors')
                @if (session('login_error'))
                    <div class="alert alert-danger">
                        {{ session('login_error') }}
                    </div>
                @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                     <button type="submit" class="btn btn-default">Sign In</button>
                     <button type="button" class="btn btn-default" onClick="location.href='{{ route("register") }}'">Sign Up</button>
                  </div>
               </div>
            </form>
            <div class="row clearfix social-login">
                <div class="col-md-4"><a href="/login/auth/facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i> Sign in with Facebook</a></div>
                <div class="col-md-4"><a href="/login/auth/google"><i class="fa fa-google-plus-square" aria-hidden="true"></i> Sign in with Google</a></div>
                <div class="col-md-4"><a href="/login/auth/linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i> Sign in with LinkedIn</a></div>
            </div>
        </div>
    </div> <!-- /container -->
@stop
