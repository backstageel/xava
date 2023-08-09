<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class saleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;
    public $username;

    public function __construct($salesData ,$username)
    {
        $this->sales = $salesData['sales'];
        $this->username= $username;


    }


    public function build()
    {

        return $this->from('info@xava.co.mz')
            ->view('emails.sale_mail')
            ->subject('Xava Intranet Notification');
    }
}
