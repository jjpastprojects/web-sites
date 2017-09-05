@extends('mailer::emails.default')

@section('title')

@stop

@section('content')
    <h1> {{ trans('emails_welcome.h1') }}</h1>
    <p> {{ trans('emails_welcome.p') }}</p>
@stop

