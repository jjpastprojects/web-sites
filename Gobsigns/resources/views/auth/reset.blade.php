@extends('layouts.guest')

    @section('content')
        <div class="full-content-center animated fadeInDownBig">
            <a href="/"><img src="/assets/img/ems-small.png" class="" alt="Logo"></a>
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>{!! trans('messages.Reset') !!}</strong> {!! trans('messages.Password') !!}</h2>
                    
                    <form role="form" action="{!! URL::to('/password/reset') !!}" method="post">
                        <input type="hidden" name="token" value="{!! $token !!}">
                        {!! csrf_field() !!}
                        <div class="form-group login-input">
                        <i class="fa fa-sign-in overlay"></i>
                        <input type="text" name="email" id="email" class="form-control text-input" placeholder="Email">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password" i="password" class="form-control text-input" placeholder="New Password">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password_confirmation" i="password_confirmation" class="form-control text-input" placeholder="New Confirm Password">
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> {!! trans('messages.Reset Password') !!}</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center"><a href="{!! URL::to('/') !!}"><i class="fa fa-lock"></i> {!! trans('messages.Back to login') !!}</a></p>
                </div>
            </div>
        </div>
    @stop