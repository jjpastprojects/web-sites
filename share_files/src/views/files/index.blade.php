@extends('shareFiles::layout.master')

@section('title')

@stop

@section('content')
    @include('shareFiles::partials.search')
    @include('shareFiles::partials.files')
@stop

