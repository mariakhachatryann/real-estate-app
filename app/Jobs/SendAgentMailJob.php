<?php

namespace App\Jobs;

use App\Mail\AgentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAgentMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $phone;
    protected $message;
    protected $agentDetails;

    public function __construct($email, $phone, $message, $agentDetails)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->agentDetails = $agentDetails;
    }

    public function handle()
    {
        Mail::to($this->agentDetails->email)->send(new AgentMail($this->email, $this->phone, $this->message, $this->agentDetails));
    }
}
