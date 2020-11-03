<?php

namespace Blog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Blog\Mail\ContactForm;
use Blog\Http\Requests\ContactFormRequest;

class SendContactFormJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $firstName;
    private $lastName;
    private $email;
    private $subject;
    private $message;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($firstName, $lastName, $email, $subject, $message)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       Mail::to(env('MAIL_USERNAME'))->send(new ContactForm($this->firstName, $this->lastName, $this->email, $this->subject, $this->message));
    }
}
