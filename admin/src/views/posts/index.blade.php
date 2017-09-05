@extends('admin::layout.master')

@section('content')

orderBy:
<div class="btn-group">
    <a
     class="btn btn-primary"
     href="{{ routeWithOrderBy('admin::posts.index', 'id', $direction) }}"
    >
     {{ trans('admin::posts.id') }}
    </a>

    <a
     class="btn btn-primary"
     href="{{ routeWithOrderBy('admin::posts.index', 'title', $direction) }}"
    >
     {{ trans('admin::posts.title') }}
    </a>

    <a
     class="btn btn-primary"
     href="{{ routeWithOrderBy('admin::posts.index', 'author', $direction) }}"
    >
     {{ trans('admin::posts.author') }}
    </a>

    <a
     class="btn btn-primary"
     href="{{ routeWithOrderBy('admin::posts.index', 'active', $direction) }}"
    >
     {{ trans('admin::posts.active') }}
    </a>


</div>

@can('create-posts')
<a
    href="{{route('admin::posts.create')}}"
    class="btn btn-primary pull-right"
>
    {{trans('admin::posts.new_post')}}
</a>
@endcan
<div>

{!! $posts->appends(['orderby' => $orderby, 'direction' => $direction])->links() !!}

<ul>

    @can('edit-posts')
        @foreach($posts as $post)
        <li>
                <a href="{{route('admin::posts.edit', ['id' => $post->id])}}">{{ $post['title'] }}</a>
        </li>
        @endforeach
    @else
        @foreach($posts as $post)
        <li>
                <a href="#">{{ $post['title'] }}</a>
        </li>
        @endforeach
    @endcan

</ul>

{!! $posts->appends(['orderby' => $orderby, 'direction' => $direction])->links() !!}
</div>
@stop

