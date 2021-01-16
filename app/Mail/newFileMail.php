<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class newFileMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $assunt)
    {

        $usu = User::where('id', "=", $user)->first();


        $this->user =  $usu;
        $this->subject =  $assunt;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject($this->subject);
        $this->to($this->user->email, $this->user->name);

         return $this->markdown('pages.email.newFileMail', [
            'nome' => $this->user->name
             ]);


    }
}
