<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-25
 * Time: 20:31
 */

namespace ExamenEducacionMedia\Http\Controllers;


use DB;
use ExamenEducacionMedia\Mail\ResetPasswordMail;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    }

    public function resetPassword()
    {

    }

    /*public function store()
    {
        $user = User::where('email', 'andresjch2804@gmail.com')->firstOrFail();

        Mail::to($user)->send(new ResetPasswordMail);
    }*/

}
