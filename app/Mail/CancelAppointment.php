<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelAppointment extends Mailable
{
    use Queueable, SerializesModels;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reason)
    {
        $this->subject = __('Appointment Cancellation Notification');
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reason = $this->reason;
        return $this->subject($this->subject)->view('admin.emails.cancel-appointment', compact('reason'));
    }
}
