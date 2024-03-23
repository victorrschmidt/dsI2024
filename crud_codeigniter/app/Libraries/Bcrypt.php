<?php

namespace App\Libraries;

class Bcrypt {
    private static $PREFIXO = '2a';
    private static $CUSTO = 8;
    private static $LARGURA = 22;

    public static function hash($string) {
        $salt = self::gerarSalt();
    
        $hash_string = self::gerarHashString(self::$CUSTO, $salt);
    
        return crypt($string, $hash_string);
    }

    private static function gerarSalt() {
        $salt = uniqid(mt_rand(), true);
    
        $salt = base64_encode($salt);
        $salt = str_replace('+', '.', $salt);
    
        return substr($salt, 0, self::$LARGURA);
    }

    private static function gerarHashString($custo, $salt) {
        return sprintf('$%s$%02d$%s$', self::$PREFIXO, $custo, $salt);
    }
    
    public static function check($string, $hash) {
        return (crypt($string, $hash) === $hash);
    }
}