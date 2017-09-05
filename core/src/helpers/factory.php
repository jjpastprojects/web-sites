<?php

function ufactory($model, $limit=1){
  if($limit == 1)
    return factory($model);

  return factory($model, $limit);
}
