@extends('blog::layout.master')

@section('content')

<ul>
@foreach($posts as $post)
    <li><a href="{{ route('blog::show_post', ['slug' => $post->slug]) }}"> {{ $post->title}} </a></li>
@endforeach
<ul>

@stop
