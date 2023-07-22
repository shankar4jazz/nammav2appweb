<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SmsController extends Controller
{
    /**
     * Show the sms send view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('sms.sms');
    }

    /**
     * sent to mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function sentsms(Request $request)
    {
        $mobile_no = $request->mobile_no;
        $text = $request->first_name;

        sentSMS($mobile_no, $text);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
