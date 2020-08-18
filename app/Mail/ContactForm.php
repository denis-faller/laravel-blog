<?php

namespace Blog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/** 
 * Отправляемый класс формы контактов
 */
class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $lastName;
    public $email;
    public $subjectForm;
    public $messageForm;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firstName, $lastName, $email, $subjectForm, $messageForm)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->subjectForm = $subjectForm;
        $this->messageForm = $messageForm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_USERNAME'))
                ->subject("Письмо с формы контактов")
                ->view('emails.contact.request');
    }
}
