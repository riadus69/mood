<?php

namespace App\Helpers;


class MoodHelper
{


    /**
     * @param $val
     * @param array $get_grid
     * @return string
     */
    public function TransformIdColumnToMood($val, array $get_grid): string {
        if (false !== $key = array_search($val, $get_grid)) {
            return $key;
        } else {
            return false;
        }
    }



}