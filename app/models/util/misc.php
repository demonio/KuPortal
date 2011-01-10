<?php

class Misc{
    /**
     * Genera Claves aleatorias...
     *
     * @param int $length
     */
    public static function generarClave($length) {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $cad = '';
        for ($i = 0; $i < $length; $i++) {
            $cad .= substr($str, rand(0, 62), 1);
        }
        return $cad;
    }
}
?>
