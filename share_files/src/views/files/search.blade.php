@extends('shareFiles::layout.master')

@section('title')

@stop

@section('content')
    <div id="shareFiles_search" >
        <div class="row">

            <div class="col-md-6 col-md-push-3">
                    @include('shareFiles::partials.search')
            </div>

        </div>

        <div class="row">

            <aside class="col-md-3">
                @include('shareFiles::partials.statistics')
            </aside>

            <main class="col-md-6">
                @include('shareFiles::partials.files')
            </main>

            <aside class="col-md-3">
            </aside>

        </div>
    </div>
@stop

@section('script')
<script>
    var v = new Vue({
            el: '#shareFiles_search',
            data: {
                files: {!! json_encode($files) !!},
                shownFiles: [],
                filesFilter: []
            },
            methods: {
                addFilter: function(key, value){
                    if(typeof(this.filesFilter[key]) == 'undefined') this.filesFilter[key] = value;
                    else this.filesFilter[key] = value;

                    this.applyFilesFilter(key, value);
                },
                applyFilesFilter: function(key, value){
                    this.shownFiles = this.files.filter(function(v, k, arr){
                            if(v[key] == value) return true;
                            return false;
                    });
                }
            },
            ready: function(){
                this.shownFiles = this.files;
            }
        });
</script>
@endsection
