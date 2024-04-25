<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $phone;
    public $message;
    public $agentDetails;

    public function __construct($email, $phone, $message, $agentDetails)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->agentDetails = $agentDetails;
    }

    public function build()
    {
        return $this->view('agent.mail', [
            'email' => $this->email,
            'phone' => $this->phone,
            'mess' => $this->message,
            'agentName' => $this->agentDetails->username
        ])->subject('You have got a new message');
    }
}
