<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
class SmsController extends Controller
{
    
    public function index(Request $request)
    {
        return view('admin-sms.sms');
    }

    /**
     * sent to mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
     public function sendSms(Request $request)
    {
        $mobile_no = $request->mobile_no;
        $text = $request->text;

        $data =  sentSMS($mobile_no, $text);
        
        if ($data['status'] == 'Success') {
            $message = __('sms sent successfully');
        } else {
            $message =  __('sma sent failed!');
        }
        return redirect(route('sms-send.index'))->withSuccess($message);


        exit();
    }
}
