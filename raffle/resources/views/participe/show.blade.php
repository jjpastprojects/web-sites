@extends('layout.master')

@section('content')
<?php $question = $raffle->nextQuestion() ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $raffle->title }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                            action="{{ route('participe.store', ['raffle_id' => $raffle->id, 'question_id' => $question->id]) }}">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @include('participe.partials.'.$question->layout())

                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                       @if($raffle->hasNextQuestion())
                                           Next Question
                                       @else
                                            Finish
                                       @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
