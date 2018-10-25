<?php

namespace ExamenEducacionMedia\Http\Controllers\Auth;

use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|exists:users,' . $this->username() . ',active,1',
            'password'        => 'required',
        ], [
            $this->username() . '.exists' => 'Las credenciales son incorrectas o la cuenta ha sido desactivada',
        ]);
    }

    public function authenticated($request, $user)
    {
        //TODO: Redirect depending of user's role
        /*if ($user->hasRole('[role_name]')) {
            return redirect()->route('[route_name]');
        }*/

        if ($user->session_id) {
            \Session::getHandler()->destroy($user->session_id);
        }

        $user->session_id = session()->getId();
        $user->save();

        return redirect()->intended($this->redirectTo);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function redirectToProvider()
    {
        return Socialite::with('siie')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::with('siie')->user();

        try {
            $u    = User::where('provider_id', $user->id)->firstOrFail();
            $data = [
                'nombre_completo'              => $user->user['persona']['nombre_completo'],
                'email'                        => $user->email,
                'username'                     => $user->nickname,
                'jarvis_user_access_token'     => $user->token,
                'jarvis_user_token_expires_in' => $user->expiresIn,
                'jarvis_user_refresh_token'    => $user->refreshToken,
            ];
            User::actualizarUsuario($u, $data);
        } catch (\Exception $e) {
            $data = [
                'uuid'                         => Uuid::uuid4()->toString(),
                'nombre_completo'              => $user->user['persona']['nombre_completo'],
                'email'                        => $user->email,
                'username'                     => $user->nickname,
                'api_token'                    => str_random(60),
                'active'                       => $user->user['active'],
                'provider_id'                  => $user->id,
                'provider'                     => 'jarvis',
                'jarvis_user_access_token'     => $user->token,
                'jarvis_user_token_type'       => 'Bearer',
                'jarvis_user_token_expires_in' => $user->expiresIn,
                'jarvis_user_refresh_token'    => $user->refreshToken,
            ];

            $u = User::crearUsuario($data);
        }

        \Auth::login($u, true);

        return redirect()->route('welcome');
    }
}
