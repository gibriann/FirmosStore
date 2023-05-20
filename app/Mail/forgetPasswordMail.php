<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $token, $nama;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token, $nama)
    {
        $this->email = $email;
        $this->token = $token;
        $this->nama = $nama;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.forgetPassword')
        ->subject('Firmos Store - Lupa Password');
    }
}
