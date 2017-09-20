<?php

namespace App\Mail;

use App\User;
use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // generate link
        $encryptedId = Crypt::encrypt($this->user->id);

        // ex: domain.com/verify?token=xxx
        $link = route('signup.verify', [
            'token' => $encryptedId
        ]);

        return $this->view('email.verify', compact('link'));
    }
}
