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

    /**
     * @param $list
     * @return array
     */
    public function shuffle_assoc($list): array {
        if (!is_array($list)) return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }
        return $random;
    }


}