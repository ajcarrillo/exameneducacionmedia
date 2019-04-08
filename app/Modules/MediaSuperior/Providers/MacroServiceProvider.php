<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-21
 * Time: 23:02
 */

namespace MediaSuperior\Providers;


use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Builder::macro('plantelConMunicipioLocalidad', function () {
            $this->join('geodatabase.mun_loc_qroo_camp as geo', function ($join) {
                $join->on('p.cve_ent', '=', 'geo.CVE_ENT')
                    ->on('p.cve_mun', '=', 'geo.CVE_MUN')
                    ->on('p.cve_loc', '=', 'geo.CVE_LOC');
            });
        });

        Builder::macro('plantelesConMunicipioLocalidad', function () {
            $this->join('geodatabase.mun_loc_qroo_camp as geo', function ($join) {
                $join->on('planteles.cve_ent', '=', 'geo.CVE_ENT')
                    ->on('planteles.cve_mun', '=', 'geo.CVE_MUN')
                    ->on('planteles.cve_loc', '=', 'geo.CVE_LOC');
            });
        });

        Builder::macro('nombreCompletoUsuario', function () {
            $this->addSelect(DB::raw("concat_ws(' ', nombre, primer_apellido, segundo_apellido) as nombre_completo"));
        });

        Builder::macro('conPrimeraOpcion', function () {
            return $this->join('seleccion_ofertas_educativas', function ($join) {
                $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                    ->where('seleccion_ofertas_educativas.preferencia', 1);
            })
                ->join('ofertas_educativas', 'seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
                ->join('planteles', 'ofertas_educativas.plantel_id', '=', 'planteles.id');
        });
    }

    public function register()
    {

    }
}
