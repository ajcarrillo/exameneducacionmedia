<?php

namespace ExamenEducacionMedia\Mail;

use ExamenEducacionMedia\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $token;
    protected $baseURL;

    public function __construct(User $user, $token)
    {
        $this->token   = $token;
        $this->user    = $user;
        $this->baseURL = route('reset.password', $this->token);
    }

    public function build()
    {

        $url            = $this->baseURL;
        $user_full_name = get_full_name_from_user($this->user);

        return $this->view('emails.reset_password', compact('user_full_name', 'url'));
    }
}
