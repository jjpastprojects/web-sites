@extends('layout.master')

@section('content')

    @include('questions.partials.choose_question_type')

    @include('questions.partials.'.request('question_type', 'multiple_choice'))

@stop
