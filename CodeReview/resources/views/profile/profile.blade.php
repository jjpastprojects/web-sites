@extends('app')

@section('title')

@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Lang::get("profile.$type")}}</div>
                <div class="panel-body">
                    @include('partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="/profile/store">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="name" value="{{ $name }}">
                        <input type="hidden" name="max" value="{{ $max }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        @if($min == 0)
                            <input type="hidden" name="min" value="{{ 1 }}">
                        @else
                            <input type="hidden" name="min" value="{{ $min }}">
                        @endif

                        <h2 class="col-md-6 control-label">{{ $name }}</h2>

                        <div id="form-groups">
                            @include("profile.partials.formGroups")
                        </div>

                        <br id="add_before"/>

                        @if($min != $max)
                            @include('profile.partials.add')
                        @endif

                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ Lang::get('general.next') }}
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

