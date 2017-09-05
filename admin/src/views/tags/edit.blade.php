@extends('admin::layout.master')

@section('content')
<form action="{{ route('admin::tags.update', ["tags" => $tag->id]) }}" method="post" class="form">
{{ csrf_field() }}
<input type="hidden" name="_method" value="PUT">
<input
    type="text"
    class="form-control"
    name="name"
    placeholder={{ trans('core::general.name')}}
    value="{{ $tag['name'] }}"
>
<input
    type="text"
    class="form-control"
    name="title"
    placeholder={{ trans('core::general.title')}}
    value="{{ $tag['title'] }}"
>
<input
    type="text"
    class="form-control"
    name="subtitle"
    placeholder={{ trans('core::general.subtitle')}}
    value="{{ $tag['subtitle'] }}"
>
<input
    type="text"
    class="form-control"
    name="page_image"
    placeholder={{ trans('core::general.page_image')}}
    value="{{ $tag['page_image'] }}"
>
<input
    type="text"
    class="form-control"
    name="meta_description"
    placeholder={{ trans('core::general.meta_description')}}
    value="{{ $tag['meta_description'] }}"
>
<input
    type="text"
    class="form-control"
    name="layout"
    placeholder={{ trans('core::general.layout')}}
    value="{{ $tag['layout'] }}"
>
<label for="direction">{{ trans('admin::tag.normal') }}</label>

<input
    type="radio"
    @if($tag['direction'])
        checked="checked"
    @endif
    name="direction"
    value="1"
>
<label for="direction">{{ trans('admin::tag.reverse') }}</label>
<input
    type="radio"
    @if(! $tag['direction'])
        checked="checked"
    @endif
    name="direction"
    value="0"
>

<button
    class="btn btn-lg btn-primary btn-block"
    type="submit">{{ trans('core::general.update') }}
</button>

</form>

@stop
