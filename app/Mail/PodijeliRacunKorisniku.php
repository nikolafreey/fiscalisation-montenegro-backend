<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PodijeliRacunKorisniku extends Mailable
{
    use Queueable, SerializesModels;

    public $racun;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($racun)
    {
        $this->racun = $racun;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.podijeli-racun-korisniku', [
            'racun' => $this-racun
        ]);
    }
}
