@extends('admin::layout.master')

@section('title')

@stop

@section('content')
    @include('admin::dashboard.partials/'.$page)
@stop

