<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/aspirantes-listado-general', 'Reportes\AspiranteController@export')
    ->name('reporte.general.aspirnates');

Route::post('/listado-general-mslp', 'Reportes\AspiranteController@listadoGeneralSMLP')
    ->name('reporte.general.mslp');

Route::get('/prueba-stress', function () {
    $repo = new \Subsistema\Repositories\OfertaEducativaRepository();

    $json = $repo->catalogoOpcionesEducativas()->get();

    return ok(compact('json'));
});

Route::prefix('/developer-zone')
    ->name('developer.')
    ->middleware([ 'auth', 'role:supermario' ])
    ->group(function () {
        Route::get('/services', 'Developer\ServicesController@index')->name('services');
    });

Route::get('/reset-password/faker', function () {
    $user  = \ExamenEducacionMedia\User::where('email', 'andresjch2804@gmail.com')->firstOrFail();
    $token = str_random(60);

    return new \ExamenEducacionMedia\Mail\ResetPasswordMail($user, $token);
});

Route::get('/olvide-contrasena', 'ResetPasswordController@index')->name('forgot.password');
Route::post('/olvide-contrasena', 'ResetPasswordController@store')->name('forgot.password');

Route::get('/restablecer-contrasena/{token}', 'ResetPasswordController@showResetForm')->name('reset.password');
Route::post('/update-password', 'ResetPasswordController@resetPassword')->name('cambiar.contrasena');

Route::prefix('/reportes')
    ->middleware([ 'auth', 'role:departamento|subsistema|plantel' ])
    ->name('reportes.')
    ->group(function () {
        Route::post('/oferta', 'ReporteController@oferta')->name('oferta');
        Route::get('/', 'ReporteController@index')->name('index');
    });

Route::view('/perfil', 'profile')
    ->middleware([ 'auth' ]);

Route::view('/aviso-privacidad', 'aviso_privacidad')->name('aviso.privacidad');

Route::post('/login-as-user', 'Auth\LoginAsController@loginAsUser')
    ->middleware([ 'auth', 'role:departamento' ])
    ->name('login.as.user');

Route::post('/logout-as-user', 'Auth\LoginAsController@logout')
    ->middleware([ 'auth' ])
    ->name('logout.as.user');

/*Route::middleware([ 'auth', 'role:departamento' ])
    ->prefix('/administracion')
    ->as('administracion.')
    ->group(function () {
        Route::view('/', 'administracion.home')->name('home');

        Route::prefix('/planteles')
            ->as('planteles.')
            ->group(function () {
                Route::view('/{all?}', 'administracion.planteles.home')
                    ->where([ 'all' => '.*' ])
                    ->name('spa');
            });
    });*/

Route::middleware([ 'auth', 'role:plantel|subsistema|aspirante' ])
    ->prefix('/')
    ->name('centro-descarga.')
    ->group(function () {
        Route::get('/documentos', 'CentroDescargaController@index')->name('cdescarga.index');
        Route::get('/descargar/{id}', 'CentroDescargaController@descargar')->name('descargar.doc');
    });


/*Route::view('/home', 'home')->middleware([ 'auth' ]);*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*Route::get('/registro', function () {
    return view('welcome');
})->middleware([ 'isRegistro' ]);

Route::get('/subsistema/aforo', function () {
    return view('welcome');
})->middleware([ 'isAforo' ]);

Route::get('/subsistema/oferta', function () {
    return view('subsistemas.home');
})->middleware([ 'isOferta' ]);*/


Route::group([ 'prefix' => '/planteles', 'middleware' => [ 'auth', 'role:plantel', 'hasPlantel' ] ], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

/* Login con jarvis*/
Route::get('/loging/oauth', 'Auth\LoginController@redirectToProvider')->name('login.oauth');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback')->name('login.oauth.callback');

Route::get('login/oauth-password', 'Auth\LoginJarvisController@showLoginForm')->name('login.jarvis');
Route::post('login/oauth-password', 'Auth\LoginJarvisController@login')->name('login.jarvis');
/*Login con jarvis*/

Auth::routes($options = [ 'register' => false, 'reset' => false ]);

Route::view('/cambiar-contrasena', 'update_password.index')
    ->middleware([ 'auth' ])
    ->name('update.password');
Route::patch('/cambiar-contrasena', 'UpdatePasswordController@update')
    ->middleware([ 'auth' ])
    ->name('update.password');
