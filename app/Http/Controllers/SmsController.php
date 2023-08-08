<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
class SmsController extends Controller
{
    
    /**
     * sent to mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function sendSms(Request $request)
    {
        $mobile_no = $request->mobile_no;
        $text = $request->first_name;

        $data =  sentSMS($mobile_no, $text);     


        if ($data['status'] == 'Success') {
            $message = 'sms sent successfully';
        } else {
            $message =  'sma sent failed!';
        }

        $response = [           
            'message' => $message
        ];
        return comman_custom_response($response);
        


        exit();
    }
}
