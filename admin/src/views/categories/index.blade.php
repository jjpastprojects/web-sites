@extends('admin::layout.master')

@section('content')


<a
    href="{{route('admin::categories.create')}}"
    class="btn btn-primary pull-right"
>
    {{trans('blog::category.new_category')}}
</a>

 {!! $categories->appends(['orderby' => $orderby, 'direction' => $direction])->links() !!}

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <a
                    href="{{ routeWithOrderBy('admin::categories.index', 'id', $direction) }}">
                    {{ trans('admin::category.id') }}
                </a>
            </th>

            <th>
                <a
                    href="{{ routeWithOrderBy('admin::categories.index', 'name', $direction) }}">
                    {{ trans('blog::category.name') }}
                </a>
            </th>
            <th class="hidden-md">
                <a
                    href="{{ routeWithOrderBy('admin::categories.index', 'description', $direction) }}">
                    {{ trans('blog::category.description') }}
                </a>
            </th>
           <th>
                <a>
                    {{ trans('admin::category.action') }}
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <a
                        href="{{ route('admin::categories.edit', ['id' => $category->id]) }}"
                    >
                        {{ $category->id}}
                    </a>
                </td>
              <td>{{ $category->name}}</td>
              <td class="hidden-md">{{ $category->description }}</td>
              <td>
                  <a href="{{ route('admin::categories.edit', ['categories' => $category->id]) }}">
                      <span class="glyphicon glyphicon-pencil" ></span>
                  </a>
                  @include('admin::categories.partials.delete')
              </td>
            </tr>
        @endforeach
    </tbody>
</table>

    {!! $categories->appends(['orderby' => $orderby, 'direction' => $direction])->links() !!}
@stop
