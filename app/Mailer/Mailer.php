<?php


namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{

    public function sendTo($template, array $data, $email)
    {
        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {

            $message->from(config('site.server_admin_email'), 'blog.ifanatic.cn');

            $message->to($email);
        });
    }
}