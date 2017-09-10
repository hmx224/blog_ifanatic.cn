<?php

namespace App\Notifications;

use App\Channels\SendCloudChannel;
use App\Mailer\UserMailer;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //使用站内信
//        return ['mail']; //使用sendCloud 没用默认的
        return ['database', SendCloudChannel::class]; //引用自定义邮件发送
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => Auth::guard('api')->user()->name,
        ];

    }

    //sendCloud 邮件提醒
    public function toSendcloud($notifiable)
    {
        (new UserMailer())->followNotifyEmail($notifiable->email);
    }

//    public function toSendcloud($notifiable)
//    {
//        /* 自定义模板发送邮件 */
//        // 邮件内容
//        $EMAILResult = new EMAILResult();
//        $EMAILResult->to = Auth::guard('api')->user()->email;
//        $EMAILResult->cc = '3434744@qq.com';
//        $EMAILResult->subject = '用户关注提示';
//        $EMAILResult->content = '你好,知乎app上' . Auth::guard('api')->user()->name . '关注了你';
//        // 发送邮件
//        Mail::send('email_follow', ['EMAILResult' => $EMAILResult], function ($m) use ($EMAILResult) {
//            $m->to($EMAILResult->to, '尊敬的用户')
//                ->cc($EMAILResult->cc)
//                ->subject($EMAILResult->subject);
//        });
//
//        /* 使用Sendcloud 的模板发送邮件 */
//    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', url('/'))
//            ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
