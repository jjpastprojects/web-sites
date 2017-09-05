<?php

namespace Lembarek\Core\Schema;

use DB;

class Schema
{

    public static function get_column_type($table, $column)
    {
        $type =  \DB::select(\DB::raw("SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS  WHERE table_name = '$table' AND COLUMN_NAME = '$column';"))[0]->DATA_TYPE;

        return $type;
    }

    public static function get_enum_values($table, $field)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$field'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach (explode(',', $matches[1]) as $value) {
            $values[] = trim($value, "'");
        }
        return $values;

    }
}
