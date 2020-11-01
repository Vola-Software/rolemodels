<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolVisitRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $schoolVisit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($schoolVisit)
    {
        $this->schoolVisit = $schoolVisit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('/visits');

        return $this->subject('Приета заявка за посещение от ролеви модел!')
                    ->markdown('emails.school-visit-request-approved')
                    ->with('schoolVisit', $this->schoolVisit)
                    ->with('url', $url);
    }
}
