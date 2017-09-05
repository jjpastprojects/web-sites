<?php

function get_langs_files(){

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
            var_dump($filename);
            #$trans[basename($package).'::'.$filename] = trans(basename($package).'::'.$filename);
        }
    }

    return $trans;
}
