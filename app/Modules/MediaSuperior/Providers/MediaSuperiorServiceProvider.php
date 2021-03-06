<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-06
 * Time: 19:33
 */

namespace MediaSuperior\Providers;


use DB;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Subsistema\Models\SedeAlterna;

class MediaSuperiorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'sede_alterna' => SedeAlterna::class,
        ]);

        Builder::macro('aspirantesFields', function ($fields) {
            foreach ($fields as $field) {
                $this->addSelect("a.{$field}");
            }
        });

        Builder::macro('usersFields', function ($fields) {
            if ($fields->count()) {
                $this->join('users as u', 'a.user_id', '=', 'u.id');
                $this->addSelect(DB::raw('u.id as user_id'));
                foreach ($fields as $field) {
                    $this->addSelect("u.{$field}");
                }
            }
        });
    }

    public function register()
    {

    }
}
