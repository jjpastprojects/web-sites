@extends('layouts.guest')
    @section('content')
        
        <!-- Begin 404 Page -->
        <div class="full-content-center animated bounceIn">
            <h1>Error 404</h1>
            <h2>{!! $exception->getMessage() !!}</h2>
            <p>{!! trans('messages.Page not found!') !!}</p>
            <p>{!! trans('messages.Back to') !!} <a href="/">{!! trans('messages.Dashboard') !!}</a></p>
        </div>
        <!-- End 404 Page -->
    @stop