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
    function get_aspirante(): \Aspirante\Models\Aspirante
    {
        return Auth::user()->aspirante;
    }
}

if ( ! function_exists('get_full_name_from_user')) {
    function get_full_name_from_user($user)
    {
        if ( ! $user) {
            return;
        }

        return "{$user->nombre} {$user->primer_apellido} {$user->segundo_apellido}";
    }
}

if ( ! function_exists('is_etapa_registro')) {
    function is_etapa_registro()
    {
        return \ExamenEducacionMedia\Models\EtapaProceso::isRegistro();
    }
}

if ( ! function_exists('get_etapa')) {
    function get_etapa($nombre)
    {
        return \ExamenEducacionMedia\Models\EtapaProceso::getEtapa($nombre);
    }
}

if ( ! function_exists('get_billy_url')) {
    function get_billy_url()
    {
        return env('BILLY_SERVICE_URL');
    }
}

if ( ! function_exists('get_user')) {
    function get_user(): \ExamenEducacionMedia\User
    {
        return Auth::user();
    }
}

if ( ! function_exists('get_user_roles')) {
    function get_user_roles(): \Illuminate\Support\Collection
    {
        return get_user()->getRoleNames();
    }
}

if ( ! function_exists('get_numero_opcion')) {
    function get_numero_opcion()
    {
        return DB::table('seleccion_ofertas_educativas')
            ->where('aspirante_id', get_aspirante()->id)
            ->where('oferta_educativa_id', get_aspirante()->asignacion->oferta_educativa_id)
            ->value('preferencia');
    }
}
