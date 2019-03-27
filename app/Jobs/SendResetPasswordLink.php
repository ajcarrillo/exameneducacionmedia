<?php

namespace ExamenEducacionMedia\Jobs;

use ExamenEducacionMedia\Mail\ResetPasswordMail;
use ExamenEducacionMedia\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $token;

    public function __construct(User $user, $token)
    {
        $this->user  = $user;
        $this->token = $token;
    }

    public function handle()
    {
        Mail::to($this->user)->send(new ResetPasswordMail($this->user, $this->token));
    }
}
