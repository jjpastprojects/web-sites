@extends('admin.layout')

@section('title')

@stop

@section('content')
    <div class="container">
        <h1>{{ trans('admin.all_users') }} </h1>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
@stop

