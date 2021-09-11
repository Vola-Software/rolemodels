<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolVisitRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Създадена заявка за посещение от ролеви модел!')
                    ->markdown('emails.school-visit-request-created');
    }
}
