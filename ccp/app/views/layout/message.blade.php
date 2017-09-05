            @include('layout.include.head')
            @include('layout.include.message_head')
            @yield('content')
            @if(Session::has('global'))
                    <div class=" col-sm-12 btn btn-warning">
                            {{ Session::get('global') }}
                    </div>
            @endif
            @include('layout.include.footer')