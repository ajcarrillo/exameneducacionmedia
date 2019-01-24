<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-22
 * Time: 13:38
 */
if ( ! function_exists('get_user_full_name')) {
    function get_user_full_name()
    {
        $user = Auth::user();

        return "{$user->nombre} {$user->primer_apellido} {$user->segundo_apellido}";
    }
}

if ( ! function_exists('get_aspirante')) {
    function get_aspirante() : \Aspirante\Models\Aspirante
    {
        return Auth::user()->aspirante;
    }
}
