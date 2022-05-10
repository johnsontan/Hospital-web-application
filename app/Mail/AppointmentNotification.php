<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($date, $time, $treatment, $ms)
    {
        $this->da = $date;
        $this->ti = $time;
        $this->treatment = $treatment;
        $this->ms = $ms;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.app-noti')->with(['da' => $this->da, 'ti' => $this->ti, 'treatment' => $this->treatment, 'ms' => $this->ms]);
    }
}
