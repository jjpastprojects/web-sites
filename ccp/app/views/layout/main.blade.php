@include('layout.include.head')
<div class="wrap">
    <div class="container">
        @if(isset($info))
        <div class="row">
                <div class=" col-sm-8 col-sm-offset-2">
                        <p class="btn btn-block btn-info">
                                {{ $info }}
                        </p>
                </div>
        </div>
        @endif
        @if(Session::has('global'))
        <div class="row">
                <div class=" col-sm-8 col-sm-offset-2">
                        <p class="btn btn-block btn-info">
                            {{ Session::get('global') }}
                        </p>
                </div>
        </div>
        @endif
        @yield('content')
    </div>
</div>
@include('layout.include.footer')
