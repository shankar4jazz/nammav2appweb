<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\API\JobsViewResource;


class SmsController extends Controller
{ 
    public function sendSms(Request $request)
    {
        $mobile_no = $request->mobile_no;
        $text = $request->text;

        $data =  sentSMS($mobile_no, $text);
        var_dump($data);
        if ($data['status'] == 'Success') {
            $message = __('sms sent successfully');
        } else {
            $message =  __('sma sent failed!');
        }
        return redirect(route('sms-send.index'))->withSuccess($message);


        exit();
    }


}
