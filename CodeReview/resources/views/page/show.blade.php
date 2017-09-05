@extends('page.default')

@section('title')

@stop

@section('content-2')
<div class="container">
    <h1>{{ $page['title'] }}</h1>
    <?php echo  Page::decode($page['body']); ?>
</div>

@stop

