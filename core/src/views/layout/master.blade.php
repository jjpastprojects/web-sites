<!DOCTYPE html>
<html>
<head>

    @include('core::layout.partials.header')

    @yield('head_script')
</head>

<body>
<div class="container">

      @include('core::layout.partials.navigation')

      @include('core::layout.partials.flash')

    <div id="app">
      @yield('content')
    </div>

      @include('core::layout.partials.footer')

    @yield('script')
</div>

</body>
</html>
