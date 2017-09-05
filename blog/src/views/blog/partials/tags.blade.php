<div class="tags">
    @foreach($post->tags as  $tag)
        <span class="tag"><a href="{{ route('blog::posts_with_tag', ['name' => $tag->name]) }}">{{ $tag->name }}</a></span>
    @endforeach
</div>
