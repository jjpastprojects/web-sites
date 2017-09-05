<?php

 /**
    * Open haystack, find and replace needles, save haystack.
    *
    * @param  string $oldFile The haystack
    * @param  mixed  $search  String or array to look for (the needles)
    * @param  mixed  $replace What to replace the needles for?
    * @param  string $newFile Where to save, defaults to $oldFile
    *
    * @return void
*/
function replaceAndSave($oldFile, $search, $replace, $newFile = null)
{
    $newFile = ($newFile == null) ? $oldFile : $newFile;
    $file = file_get_contents($oldFile);
    $replacing = str_replace($search, $replace, $file);
    file_put_contents($newFile, $replacing);
}

