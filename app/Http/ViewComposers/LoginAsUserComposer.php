<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-31
 * Time: 17:11
 */

namespace ExamenEducacionMedia\Http\ViewComposers;


use ExamenEducacionMedia\Traits\LoginAsUser;
use Illuminate\View\View;

class LoginAsUserComposer
{
    use LoginAsUser;

    public function compose(View $view)
    {
        $view->with([
            'hasImpersonate' => $this->hasImpersonated(),
            'originalUser'   => $this->getOriginalUser(),
            'currentUser'    => \Auth::user(),
        ]);
    }
}
