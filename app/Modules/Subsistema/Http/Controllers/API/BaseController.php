<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-13
 * Time: 13:01
 */

namespace Subsistema\Http\Controllers\API;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Plantel;

class BaseController extends Controller
{
    protected $subsistema;

    /**
     * @param $uuid
     * @return Plantel
     */
    protected function getPlantel($uuid)
    {
        return Plantel::where('uuid', $uuid)
            ->where('subsistema_id', $this->subsistema->id)
            ->firstOrFail();
    }

    protected function setSubsistema()
    {
        $this->subsistema = \Auth::guard('api')->user()->subsistema;
    }
}
