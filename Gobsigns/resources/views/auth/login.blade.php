@extends('layouts.guest')

    @section('content')
        <!--a class="btn btn-primary btn-lg pull-right" style='margin:15px;' role="button" href="/apply">{!! trans('messages.Apply for Job') !!}</a-->
        <div class="full-content-center animated fadeInDownBig">
            <a href="/"><img src="/assets/img/ems-small.png" class="" alt="Logo"></a>
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('messages.User') !!}</strong> {!! trans('messages.Login') !!}</h2>
                    
                    <form role="form" action="{!! URL::to('/login') !!}" method="post" class="login-form">
                        {!! csrf_field() !!}
                        <div class="form-group login-input">
                        <i class="fa fa-sign-in overlay"></i>
                        <input type="text" name="username" id="username" class="form-control text-input" placeholder="Username">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password" id="password" class="form-control text-input" placeholder="Password">
                        </div>
                        <div class="checkbox">
                        <label>
                            <input type="checkbox"> {!! trans('messages.Remember me') !!}
                        </label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('messages.Login') !!}</button>
                            </div>
                        </div>

                        @if(! App\Classes\Helper::getMode())
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>Admin</td>
                                            <td>webmaster</td>
                                            <td>webmaster</td>
                                        </tr>
                                        <tr>
                                            <td>Manager</td>
                                            <td>sean</td>
                                            <td>sean</td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>marry</td>
                                            <td>marry</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </form>
                    <p class="text-center"><a href="{!! URL::to('/password/email') !!}"><i class="fa fa-lock"></i> {!! trans('messages.Forgot password?') !!}</a></p>
                </div>
            </div>
        </div>
    @stop