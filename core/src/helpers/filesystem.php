<?php

/**
* delete dir
*
* @param  string  $dir
* @return void
*/
function deleteDir($dir)
{
    if (file_exists($dir)) {
        return exec("rm -fR $dir");
    }
}



function get_subdir_files($main_dir)
{
    $dirs = scandir($main_dir);
    $result  = [];
    foreach ($dirs as $dir) {
        if ($dir === '.' || $dir === '..' || $dir === '.git') {
            continue;
        }
        if (is_file($main_dir.'/'.$dir)) {
            $result[] = "$main_dir/$dir";
        } else {
            $result = array_merge($result, get_subdir_files("$main_dir/$dir"));
        }
    }
    return $result;
}

function get_subdir_dirs($main_dir)
{
    $dirs = scandir($main_dir);
    $result  = [];
    foreach ($dirs as $dir) {
        if ($dir === '.' || $dir === '..' || $dir === '.git') {
            continue;
        }
        if (is_file("$main_dir/$dir")) {
            continue;
        }
        $result[] = "$main_dir/$dir";
        $result = array_merge($result, get_subdir_dirs("$main_dir/$dir"));
    }
    return $result;
}

function recurse_copy($source, $dest)
{
      return exec("cp -R $source $dest ");
}
