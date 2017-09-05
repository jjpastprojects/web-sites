<meta charset="utf-8">
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" >

<script>
        window.Laravel = {!! json_encode([
              'csrfToken' => csrf_token(),
        ]) !!};
</script>

<script>
    window.trans = <?php
    // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
    $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
    $trans = [];
    foreach ($lang_files as $f) {
        $filename = pathinfo($f)['filename'];
        $trans[$filename] = trans($filename);
    }

    $packages = File::directories(resource_path().'/lang/vendor');

    foreach($packages as $package){
      $lang_files = File::files($package.'/'.App::getLocale());
      foreach ($lang_files as $f) {
            $filename = pathinfo($f)['filename'];
            $trans[basename($package).'::'.$filename] = trans(basename($package).'::'.$filename);
        }
    }

    echo json_encode($trans);
    ?>;
</script>
