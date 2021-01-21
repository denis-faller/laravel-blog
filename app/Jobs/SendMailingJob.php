<?php

namespace Blog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Blog\Mail\MailingMail;

class SendMailingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $name;
    private $url;
    private $text;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name, $url, $text)
    {
        $this->email = $email;
        $this->name = $name;
        $this->url = $url;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new MailingMail($this->name, $this->url, $this->text));
    }
}
