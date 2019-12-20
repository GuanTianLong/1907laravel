<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class RegisterController extends Controller
{
        //注册视图
        public function register(){

            return view('index.register');
        }

        //获取手机验证码
        public function sendCode(){
            echo 1;
        }

        public function sendsms(){

            AlibabaCloud::accessKeyClient('<accessKeyId>', '<accessSecret>')
                ->regionId('cn-hangzhou')
                ->asDefaultClient();

            try {
                $result = AlibabaCloud::rpc()
                    ->product('Dysmsapi')
                    // ->scheme('https') // https | http
                    ->version('2017-05-25')
                    ->action('SendSms')
                    ->method('POST')
                    ->host('dysmsapi.aliyuncs.com')
                    ->options([
                        'query' => [
                            'RegionId' => "cn-hangzhou",
                            'PhoneNumbers' => "17835343496",
                            'SignName' => "乐柠教育",
                            'TemplateCode' => "SMS_180049937",
                            'TemplateParam' => "{code:123}",
                        ],
                    ])
                    ->request();
                print_r($result->toArray());
            } catch (ClientException $e) {
                echo $e->getErrorMessage() . PHP_EOL;
            } catch (ServerException $e) {
                echo $e->getErrorMessage() . PHP_EOL;
            }


        }
}
