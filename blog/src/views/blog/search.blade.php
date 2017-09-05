@extends('blog::layout.master')

@section('content')

    <div id="posts">

        <input
            type="text"
            class="form-control"
            name="query"
            v-model="query"
            v-on:keyup="search | debounce 500"
        >

        <ul>
            <li v-for="post in posts">
                <a href="/blog/@{{ post.slug}}">@{{ post.title }}</a>
            </li>
        </ul>
    </div>

@stop

@section('script')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script>
        new Vue({
            el: '#posts',
            data: {
                posts: [],
                query: ''
            },
            methods: {
                search: function(){
                    var client = algoliasearch('ZKLEHVOXTB', '94ce880aa65c982c2b505b6b8dabda26');
                    var index = client.initIndex('dev_posts');
                    index.search(this.query, function(error, results){
                        this.posts = results.hits;
                    }.bind(this));
                }
            }
        });
    </script>
@stop
