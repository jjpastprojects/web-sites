@extends('page.default')

@section('title')

@stop

@section('content-2')
<div class="container">
    <h1>{{ trans('page.title') }}</h1>
    @foreach($pages as $page)
        <ul>
            <li>
                <a href="{{ Page::titleToUrl($page['title']) }}">{{ $page['title'] }} </a>
                <div class="btn-group btn-group-sm">
                    <input page_title="{{ $page['title'] }}" after="{{ trans('page.saved') }}" type="button" value="{{ trans('page.save') }}" class='btn save_page'/>
                    <input page_title="{{ $page['title'] }}" after="{{ trans('page.deleted') }}" type="button" value="{{ trans('page.delete') }}" class='btn delete_page'/>
                </div>
            </li>
        </ul>
    @endforeach
</div>
@stop

