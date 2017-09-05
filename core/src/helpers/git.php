<?php

/**
    * init git
    *
    * @return void
*/
function initGit($path)
{
    shell_exec("cd $path && git init && git add . && git commit -m 'first init'");
}

