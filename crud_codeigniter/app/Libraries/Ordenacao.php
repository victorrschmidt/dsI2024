<?php

namespace App\Libraries;

class Ordenacao {
    public static $ORDENACAO = [
        'a_z'       => ['coluna' => 'titulo',     'parametro' => 'asc'],
        'z_a'       => ['coluna' => 'titulo',     'parametro' => 'desc'],
        'id_c'      => ['coluna' => 'id',         'parametro' => 'asc'],
        'id_d'      => ['coluna' => 'id',         'parametro' => 'desc'],
        'qtd_c'     => ['coluna' => 'quantidade', 'parametro' => 'asc'],
        'qtd_d'     => ['coluna' => 'quantidade', 'parametro' => 'desc'],
        'data_c'    => ['coluna' => 'inicio',     'parametro' => 'desc'],
        'data_d'    => ['coluna' => 'inicio',     'parametro' => 'asc'],
        'a_z_users' => ['coluna' => 'nome',       'parametro' => 'asc'],
        'z_a_users' => ['coluna' => 'nome',       'parametro' => 'desc']
    ];
}