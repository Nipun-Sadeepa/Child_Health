<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCredentials extends Mailable
{
    use Queueable, SerializesModels;
    public $CredentialDetails;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($CredentialDetails)
    {
        $this->CredentialDetails =$CredentialDetails;
        //dd($CredentialDetails);
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this);
        return $this->subject("ChildDev Login Credentials")->view('TestMail');
        //return $this->view('TestMail');
    }
}
