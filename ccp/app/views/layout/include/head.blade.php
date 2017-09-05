<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @if(Session::get('locale') == "ar")
            {{ HTML::style('css/ar.css') }}
        @else
            {{ HTML::style('bootstrap/css/bootstrap.css') }}
        @endif
        {{ HTML::style('css/main.css') }}
        {{ HTML::style('css/steps.css') }}
        {{ HTML::script('js/functions.js') }}
    </head>
    <body>
@include('layout.include.navigation')
