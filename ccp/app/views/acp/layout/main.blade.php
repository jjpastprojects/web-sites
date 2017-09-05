<!DOCTYPE html>
<html lang="en">
  <head>
        @include('acp.layout.include.head')
  </head>

  <body>
    @include('acp.layout.include.navigation')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            @include('acp.layout.include.sidebar')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
           @yield('content')
         </div>
      </div>
    </div>
  </body>
</html>
