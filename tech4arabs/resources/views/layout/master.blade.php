<!DOCTYPE html>
<html>
<head>

    @include('layout.partials.header')

</head>

<body>
<div class="container">
    @include('layout.partials.navigation')

    @include('layout.partials.flash')

    @yield('content')

    @include('layout.partials.footer')
</div>

</body>
</html>
