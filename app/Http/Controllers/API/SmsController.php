<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\API\JobsViewResource;


class SmsController extends Controller
{ 

     public function index(Request $request)
    {
        return view('sms.sms');
    }

    // public function sendSms(Request $request)
    // {
    //     $mobile_no = $request->mobile_no;
    //     $text = $request->text;

    //     $data =  sentSMS($mobile_no, $text);
        
    //     if ($data['status'] == 'Success') {
    //         $message = __('sms sent successfully');
    //     } else {
    //         $message =  __('sma sent failed!');
    //     }
    //     return redirect(route('sms-send.index'))->withSuccess($message);


    //     exit();
    // }

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
