<?php

namespace App\Mail;

use App\Models\Vacation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Translation\t;

class vacationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vacation;
    public $username;
    public $subject;

    public function __construct($vacation, $username, $subject)
    {
        $this->vacation = $vacation['vacation'];
        $this->username= $username;
        $this->subject= $subject;


    }

    public function build()
    {

        return $this->from('info@xava.co.mz')
            ->view('emails.vacation')
            ->subject($this->subject);
    }
}
