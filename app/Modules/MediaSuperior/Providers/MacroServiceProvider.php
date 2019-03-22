<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-21
 * Time: 23:02
 */

namespace MediaSuperior\Providers;


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
    }

    public function register()
    {

    }
}
