@extends('admin::layout.master')

@section('content')
<form action="{{ route('admin::categories.update', ["categories" => $category->id]) }}" method="post" class="form">
{{ csrf_field() }}
<input type="hidden" name="_method" value="PUT">
<input
    type="text"
    class="form-control"
    name="name"
    placeholder={{ trans('core::general.name')}}
    value="{{ $category['name'] }}"
>
<input
    type="text"
    class="form-control"
    name="model"
    placeholder={{ trans('core::general.model')}}
    value="{{ $category['model'] }}"
>
<input
    type="number"
    class="form-control"
    name="parent"
    placeholder={{ trans('core::general.parent')}}
    value="{{ $category['parent'] }}"
>

<textarea
    class="form-control textarea"
    name="description"
    placeholder={{ trans('core::general.description')}}
>{{ $category['description'] }}</textarea>


<button
    class="btn btn-lg btn-primary btn-block"
    type="submit">{{ trans('core::general.update') }}
</button>

</form>

@stop
