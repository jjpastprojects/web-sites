@extends('app')

@section('title')

@stop

@section('content')
    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th>{{ trans('profile.variable_name') }}</th>
                <th>{{ trans('profile.variable_value') }}</th>
                <th>{{ trans('profile.update') }}</th>
                <th>{{ trans('profile.delete') }}</th>
            </tr>
           @foreach($variables as $variable)
                <tr>
                    <td> {{ Profile::getVariableById($variable->variable_id)->name }} </td>
                    <td> {{ $variable->values }}</td>
                    <td><a href="/profile/update/{{ $variable->variable_id }}"> {{ trans('genenal.update') }} </a></td>
                     <td>
                        <form method="POST" action="/profile/delete/">
                            {!! csrf_field() !!}
                            {!! method_field('delete') !!}
                                <input type="submit" value="{{ trans('general.delete') }}" />
                                <input type="hidden" name="variable_id" value={{ $variable->variable_id }} />
                        </form>
                      </td>
                </tr>
           @endforeach
        </table>
    </div>
@stop

