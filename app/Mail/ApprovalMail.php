<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $appointment_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment_id)
    {
        $this->subject = __('Appointment Approval Notification');
        $this->appointment_id = $appointment_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $appointment_id = $this->appointment_id;
        return $this->subject($this->subject)->view('admin.emails.approval', compact('appointment_id'));
    }
}
