<div class="search" id="search">
    <form method="get" action="{{route('file::search')}}">
        <div class="form-group">
                <input type="text" class="form-control" name="q" value="{{ old('q') }}"/>
        </div>
    </form>
</div>

