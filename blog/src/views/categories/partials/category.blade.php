<li
id="category-{{$category->id}}"
data-parent="category-{{$category->parent}}"
class="category {{$level == '0'? 'show': 'hide'}} category-level-{{$level++}}"
>

<?php $childrenCategories = $allCategories->filter(function($c)use($category){return $c->parent == $category->id; }); ?>

@if(count($childrenCategories))
<a>{{ $category->name }}</a>
@else
<a href={{ route('blog::categories.posts', ['category' => $category->name]) }}>{{ $category->name }}</a>
@endif
</li>
@if(count($childrenCategories))
    <ul class="hide nav nav-sidebar" data-parent="category-{{$category->id}}">
        @include('blog::categories.partials.categories', ['categories' => $childrenCategories])
    </ul>
@endif
<?php $level--; ?>
