<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" >
        <script>
              window.Laravel = <?php echo json_encode([
                  'csrfToken' => csrf_token(),
              ]); ?>
         </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
              @yield('content')
            </div>
        </div>
        <script type="text/javascript" charset="utf-8" src="/js/app.js"></script>
    </body>
</html>
