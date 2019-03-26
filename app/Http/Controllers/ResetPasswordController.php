<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-25
 * Time: 20:31
 */

namespace ExamenEducacionMedia\Http\Controllers;


use Auth;
use DB;
use ExamenEducacionMedia\Mail\ResetPasswordMail;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('forgot_password');
    }

    public function store(Request $request)
    {
        $this->validateEmail($request);

        $token = str_random(60);

        DB::table('password_resets')
            ->insert([
                'email' => $request->email,
                'token' => $token,
            ]);

        $user = User::where('email', $request->email)->firstOrFail();

        Mail::to($user)->send(new ResetPasswordMail($user, $token));

        flash('Hemos enviado por correo electrónico su enlace de restablecimiento de contraseña!')->success();

        return back();
    }

    protected function validateEmail(Request $request)
    {
        $request->validate([ 'email' => 'required|email|exists:users,email' ]);
    }

    public function showResetForm(Request $request, $token = NULL)
    {
        $email = DB::table('password_resets')
            ->where('token', $token)
            ->select('email')
            ->first();

        return view('reset_password')->with(
            [ 'token' => $token, 'email' => $email->email ]
        );
    }

    public function resetPassword(Request $request)
    {
        $request->validate($this->rules());

        $user = User::where('email', $request->email)->firstOrFail();

        return $this->updatePassword($user, $request->password);
    }

    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    protected function updatePassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        $this->guard()->login($user);

        return redirect('/login');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
