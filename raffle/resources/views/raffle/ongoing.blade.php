@extends('layout.master')

@section('content')
<table class="table">
    <thead>
    <tr>
        <th>title</th>
        <th>prize</th>
        <th>deadline</th>
        <th>score</th>
    </tr>
    </thead>
    @foreach($raffles as $raffle)
    <tbody>
    <tr>
        <td>{{ $raffle->title }}</td>
        <td>{{ $raffle->prize }}</td>
        <td>{{ $raffle->deadline }}</td>
        <td>{{ $raffle->score() }}</td>
    </tr>
    </tbody>
    @endforeach
</table>

@stop
