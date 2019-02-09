<?php

namespace ExamenEducacionMedia\Http;

use ExamenEducacionMedia\Http\Middleware\CheckCuestionario;
use ExamenEducacionMedia\Http\Middleware\CheckForAforoMode;
use ExamenEducacionMedia\Http\Middleware\CheckForOfertaMode;
use ExamenEducacionMedia\Http\Middleware\CheckForPlantel;
use ExamenEducacionMedia\Http\Middleware\CheckForRegistroMode;
use Subsistema\Http\Middleware\CheckForSubsistema;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \ExamenEducacionMedia\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \ExamenEducacionMedia\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \ExamenEducacionMedia\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \ExamenEducacionMedia\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \ExamenEducacionMedia\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'               => \ExamenEducacionMedia\Http\Middleware\Authenticate::class,
        'auth.basic'         => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'           => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers'      => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'              => \ExamenEducacionMedia\Http\Middleware\RedirectIfAuthenticated::class,
        'signed'             => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'           => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'           => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'isAforo'            => CheckForAforoMode::class,
        'isOferta'           => CheckForOfertaMode::class,
        'isRegistro'         => CheckForRegistroMode::class,
        'hasSubsistema'      => CheckForSubsistema::class,
        'hasPlantel'         => CheckForPlantel::class,
        'cuestionario'       => CheckCuestionario::class,
        'role'               => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission'         => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ];
}
