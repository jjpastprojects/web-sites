<?php

function  getStatistics(Array $arr,Array $columns)
{
    $result = [];
    foreach($columns as $column){
        $results[$column] = getStatisticsForColumn($arr, $column);
    }
    return $results;
}

function getStatisticsForColumn(Array $arr, $column)
{
    $results = [];
    foreach($arr as $element){
        $key= $element[$column];
        if(is_array($key)) $key = array_pop($key);
        if(!array_key_exists($key, $results))
            $results[$key] = 1;
        else
            $results[$key] = ++$results[$key];
    }
    return $results;
}


/**
 * inverse direction
 *
 * @param  string  $direction
 * @return string
 */
function inverse_direction($direction)
{
    if($direction == 'desc')
        return 'asc';
    return 'desc';
}

/**
 * return url
 *
 * @param  string  $route
 * @param  string  $orderby
 * @param  string  $direction
 * @return string
 */
function routeWithOrderBy($route, $orderby, $direction)
{
    return route($route).'?orderby='.$orderby.'&direction='.inverse_direction($direction);
}

