@extends('admin::layout.master')

@section('content')
<form action="{{ route('admin::categories.store') }}" method="post" class="form">
{{ csrf_field() }}
<input
    type="text"
    class="form-control"
    name="name"
    placeholder={{ trans('core::general.name')}}
    value="{{ old('name') }}"
>

<input
    type="text"
    class="form-control"
    name="description"
    placeholder={{ trans('core::general.description')}}
    value="{{ old('description') }}"
>

<input
    type="number"
    class="form-control"
    name="parent"
    placeholder="{{ trans('core::general.parent')}}"
    value="{{ old('parent') }}"
>

<input
    type="text"
    class="form-control"
    name="model"
    placeholder="{{ trans('core::general.model')}}"
    value="{{ old('model') }}"
>


{{ trans('admin::category.reverse') }}
</label>

<button
    class="btn btn-lg btn-primary btn-block"
    type="submit">{{ trans('blog::category.new_category') }}
</button>

</form>
@stop
