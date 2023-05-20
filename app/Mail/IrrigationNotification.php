<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Coltura;


class IrrigationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $irrigationData;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($irrigationData, $testo)
    {
        $this->irrigationData = $irrigationData;
        $this->testo = $testo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $irrigations = $this->irrigationData;

        return $this->subject("Notifica da irrigazione")
            ->view('emails.irrigation_da_notificare',["message"=>$this])
            ->with(compact("irrigations"));
    }
}
