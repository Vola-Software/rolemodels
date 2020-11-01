<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolVisitRequestCanceled extends Mailable
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
        $url = url('/visits');

        return $this->subject('Отменена заявка за посещение от ролеви модел!')
                    ->markdown('emails.school-visit-request-canceled')
                    ->with('schoolVisitRequest', $this->schoolVisitRequest)
                    ->with('url', $url);
    }
}
