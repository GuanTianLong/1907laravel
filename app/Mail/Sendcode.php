<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sendcode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $code = rand(100000,999999);


        //给邮箱发送一封邮件
        $body = "尊敬的用户，您的验证码为".$code."，5分钟内输入有效，请勿泄露。";

        return $this->from('848332992@qq.com')
            ->view('emails.emails',['body'=>$body]);
        //return $this->view('view.name');
    }
}
