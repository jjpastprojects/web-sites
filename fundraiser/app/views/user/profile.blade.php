@extends("layout")
@section("content")
    <h2> Hello {{Auth::user()->userid}}</h2>
    <p> Welcome to your profile page.</p>
@stop