<?php

$files = ['others', 'git', 'string', 'files', 'filesystem', 'db', 'factory'];

foreach($files as $file){
    include_once(__DIR__.'/helpers/'.$file.'.php');
}
