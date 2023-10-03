<?php

namespace App\Mail;
// AppointmentConfirmation.php

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment; // Import the Appointment model

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $appointmentDate;
    public $appointmentTime;

    /**
     * Create a new message instance.
     */
    public function __construct($appointmentDate, $appointmentTime)
    {
        $this->appointmentDate = $appointmentDate;
        $this->appointmentTime = $appointmentTime;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())->view('mail_templates.appointment_confirmation')
    ->with([
        'appointmentDate' => $this->appointmentDate,
        'appointmentTime' => $this->appointmentTime,
    ]);

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
