<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolVisitRequestRoleModel extends Mailable
{
    use Queueable, SerializesModels;

    public $schoolVisitRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($schoolVisitRequest)
    {
        $this->schoolVisitRequest = $schoolVisitRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Приета заявка за посещение в класна стая!')
                    ->markdown('emails.school-visit-request-rolemodel')
                    ->with('schoolVisitRequest', $this->schoolVisitRequest);
    }
}
