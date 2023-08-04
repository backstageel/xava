<?php

namespace App\Mail;

use App\Models\Competition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Translation\t;

class competitionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $competitions;
    public $username;

    public function __construct($competitionsData,$username)
    {
        $this->competitions = $competitionsData['competitions'];
        $this->username= $username;


    }

    public function build()
    {

        return $this->from('info@xava.co.mz')
            ->view('emails.competition')
            ->subject('Xava Intranet Notification');
    }
}
