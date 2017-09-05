@extends('layout.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $raffle->title }}</div>
                <div class="panel-body">
                    <a href="{{ route('participe.show', ['raffle_id' => $raffle->id]) }}">
                        Start
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
