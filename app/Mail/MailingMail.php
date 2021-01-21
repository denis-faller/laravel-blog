<?php

namespace Blog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Blog\Services\SiteService;
use Blog\Models\Site;
use Illuminate\Support\Facades\Request;

/** 
 * Отправляемый класс письма рассылки
 */
class MailingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $url;
    public $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $url, $text)
    {
        $this->name = $name;
        $this->url = Request::getHost()."/".$url;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $siteService = app(SiteService::class);
        $site = $siteService->find(Site::MAIN_SITE_ID);
        // Прибавить имя блога
        $subject = "Рассылка поста ".$this->name." блога ".$site->name;
        return $this->from(env('MAIL_USERNAME'))
                ->subject($subject)
                ->view('emails.mailing.index');
    }
}
