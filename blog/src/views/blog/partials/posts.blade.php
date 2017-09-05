<div class="posts">
    @foreach($posts as $post)
        <div class="post">
            <a href="{{ route('blog::show_post', [$post->slug]) }}" title="{{ $post->title }}">{{ $post->title }}</a>
            <p>{{ substr($post->body, 0, 80) }}...</p>
        </div>
    @endforeach
</div>
