<?php

namespace App\Services;

class FilterSelectTable
{
    public static function filter($model, $ids, $column)
    {
        $tables = $model::whereIn($column, $ids)->get();

        $data = "";
        foreach ($tables as $table) {
            $data .= '<option value="'.$table->id.'">'.$table->title.'</option>';
        }
        return $data;
    }
}
