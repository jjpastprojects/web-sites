@extends('app')

@section('title')

@stop

@section('content')
    <div class="container">
        <h1>{{ trans('profile.undefinedVariables_h1') }}</h1>
        @foreach($variables as $variable_id)
        <li> <a href="{{ route('profile.set.2', ['variable_id' => $variable_id]) }}">{{ \Profile::getVariableById($variable_id)->name }}</a></li>
        @endforeach
    </div>
@stop

