<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplierInactivity extends Mailable
{
    use Queueable, SerializesModels;
    public $emailBody;
    public $emailSubject;
    public $inactiveSuppliers;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailBody, $emailSubject, $inactiveSuppliers)
    {
        $this->emailBody = $emailBody;
        $this->emailSubject = $emailSubject;
        $this->inactiveSuppliers = $inactiveSuppliers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->emailSubject )
                    ->view('emails.inactiveSuppliers')
                    ->with('emailBody', $this->emailBody)
                    ->with('inactiveSuppliers', $this->inactiveSuppliers);
    }
}
