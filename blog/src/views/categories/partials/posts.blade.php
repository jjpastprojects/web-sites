<div class="col-md-6">
<ul>
    @foreach($posts as $post)
        <li> <a href={{ route('blog::show_post', ['slug' => $post->slug]) }}>{{ $post->title}}</a></li>
    @endforeach
</ul>
</div>
