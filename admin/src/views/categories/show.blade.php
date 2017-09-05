@extends('admin::layout.master')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>{{ trans('admin::category.key') }}</th>
            <th>{{ trans('admin::category.value') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category->toArray() as $key => $value)
            <tr>
                <td>{{ trans("admin::category.$key")}}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop
