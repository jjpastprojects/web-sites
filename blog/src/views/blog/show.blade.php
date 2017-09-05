@extends('blog::layout.master')

@section('title')
    {{ $post['title'] }}
@stop

@section('content')

    <div class="container">
      <div class="post-header">
        <h1 class="post-title">{{ $post['title'] }}</h1>
        <h5>{{ $post->published_at->diffForHumans()}}</h5>
        <p class="lead post-description">{{$post['description'] }} </p>
      </div>

      <div class="row">

        <div class="col-sm-8 post-main">
          <div class="post-post">
                <hr>
                {!! nl2br(e($post['body'])) !!}
                <hr>
          </div>
        </div>
      </div>

      @include('blog::blog.partials.tags')

      @include('blog::partials.facebook_button_share')

      @include('blog::blog.partials.disqus')
    </div>

@stop

@section('script')
<script id="dsq-count-scr" src="//tech4arabs.disqus.com/count.js" async></script>
@stop
