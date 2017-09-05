@extends('shareFiles::layout.master')

@section('title')

@stop

@section('content')
    <div class="container">
        <div class="row">
            <aside class"col-md-3">
            </aside>

            <main class="col-md-6 col-md-push-3">
                <div class="row">
                        @include('shareFiles::partials.search')
                </div>
                <div class="row">
                        @include('shareFiles::partials.file_detail')
                </div>
            </main>

            <aside class="col-md-3">
            </aside>
        </div>
    </div>
@stop

