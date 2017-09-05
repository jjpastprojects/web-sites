@extends('blog::layout.master')

@section('content')
   @include('blog::categories.partials.sidebar')
   @include('blog::categories.partials.posts')
@stop
