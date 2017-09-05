@extends('admin::layout.master')

@section('content')
@can('create-posts')
    <div class="col-md-9">
        @include('core::partials.errors')
        <form class="form-horizontal" role="form" method="POST" action="{{route('admin::posts.store')}}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="col-md-9">
                <label class="control-label">{{ trans('admin::posts.title') }}</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9">
                    <label class="control-label">{{ trans('admin::posts.description') }}</label>
                    <textarea rows=5  class="form-control" name="description"> {{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-9">
                    <label class="control-label">{{ trans('admin::posts.body') }}</label>
                    <textarea class="editor" name="body">{{ old('body') }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                 <label class="control-label">{{ trans('admin::posts.published_at') }}</label>
                 <input type="date" class="form-control" name="published_at" value="{{ old('published_at') }}">
                </div>
            </div>

            <related-posts></related-posts>

            <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('admin::posts.create') }}
                        </button>
                    </div>
            </div>
        </form>
@else
    <p>{{ trans('admin::posts.can_not_create_posts') }}</p>
@endcan
@stop

@section('head_script')
@include('admin::posts.partials.tinymce')
@stop
