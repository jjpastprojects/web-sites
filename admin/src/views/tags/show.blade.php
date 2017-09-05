@extends('admin::layout.master')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>{{ trans('admin::tag.key') }}</th>
            <th>{{ trans('admin::tag.value') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tag->toArray() as $key => $value)
            <tr>
                <td>{{ trans("admin::tag.$key")}}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop
