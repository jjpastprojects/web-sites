@extends('app')

@section('title')

@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Lang::get('var.create.heading') }}</div>
                <div class="panel-body">
                    @include('partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="/variable/store">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                       <div class="form-group">
                            <label class="col-md-4 control-label">{{ Lang::get('var.name') }}</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ Lang::get('var.min') }}</label>
                            <div class="col-md-6">
                            <input type="number" class="form-control" name="min" value="{{ old('min') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ Lang::get('var.max') }}</label>
                            <div class="col-md-6">
                            <input type="number" class="form-control" name="max" value="{{ old('max') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ Lang::get('var.type') }}</label>
                            <div class="col-md-6">
                                <select name="type" id=type">
                                    <option value="enum" selected="selected">enum</option>
                                    <option value="date">date</option>
                                    <option value="string" >string</option>
                                    <option value="integer">integer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="values">
                            <label class="col-md-4 control-label">{{ Lang::get('var.values')}}</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="values" value="{{ old('values') }}">
                            </div>
                        </div>

                        <div class="form-group" id="code">
                            <label class="col-md-4 control-label">{{ Lang::get('var.code')}}</label>
                            <div class="col-md-6">
                                <code><textarea rows="6" cols="50"  name="code" value="{{ old('code') }}"></textarea></code>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ Lang::get('var.create.submit') }}
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

