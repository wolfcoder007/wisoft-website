<?php

namespace Modules\Smtp\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendingEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $message;
    public $subject;
    public $fromEmail;
    public $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    

    public function __construct($name, $message, $subject,$fromEmail)
    {
        $this->name = $name;
        $this->message = $message;
        $this->subject = $subject;
        $this->fromEmail = $fromEmail;
        $this->fromName = env('MAIL_FROM_NAME');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from($this->fromEmail,$this->fromName)
        ->subject($this->subject)
        ->markdown('smtp::admin.mail.general-email') 
        ->with([
            'userName' => $this->name,
            'themessage' => $this->message,
        ]);;
    }
}
