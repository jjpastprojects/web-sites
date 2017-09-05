@if (Session::has('flash.message'))
    <div class="alert alert-{{ Session::get('flash.level')?:'success' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash.message') }}
    </div>
@endif
