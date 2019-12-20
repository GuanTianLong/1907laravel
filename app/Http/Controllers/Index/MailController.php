<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Sendcode;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_email()
    {


        Mail::to('848332992@qq.com')->send(new Sendcode());
    }
}
