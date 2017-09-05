<?php $level = 0 ?>

@inject('categoryRepo', 'Lembarek\Blog\Repositories\CategoryRepositoryInterface')
<?php $allCategories = $categoryRepo->all(); ?>
<?php $categories = $allCategories->filter(function($category){return $category->parent == 0;}); ?>

<div class="sidebar col-md-3">
<ul class="nav nav-sidebar">
    @include('blog::categories.partials.categories')
</ul>
</div>
