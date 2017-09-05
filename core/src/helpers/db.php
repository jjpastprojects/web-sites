<?php


function get_column_type($table, $column)
{
    try {
        return \DB::connection()->getDoctrineColumn($table, $column)->getType()->getName();
    } catch (Doctrine\DBAL\DBALException $e) {
        return 'enum';
    }
}

