<?php

namespace App\Libraries;

class Formatacao {
    public static function data($arr) {
        for ($i = 0; $i < count($arr); $i++) {
            [$data, $hora] = explode(" ", $arr[$i]['inicio']);

            $data = date_format(date_create($data), 'd/m/Y');

            $arr[$i]['inicio'] = "$data às $hora";
        }

        return $arr;
    }
}