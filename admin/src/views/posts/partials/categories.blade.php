<h1>{{ trans('admin::blog.categories') }}</h1>
@if(count($post->categories))
<form action="{{ route('admin::categories_posts.destroy') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <select name="category_id" >
        @foreach($post->categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <input type="submit" value="{{ trans('core::general.delete') }}">
</form>
@endif

@if(count($post->categoriesNotIn()))
    <form action="{{ route('admin::categories_posts.store') }}" method="post">
         {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <select name="category_id" >
            @foreach($post->categoriesNotIn() as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="{{ trans('core::general.add') }}">
    </form>
@endif
