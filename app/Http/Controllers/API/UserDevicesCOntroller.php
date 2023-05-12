<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDevices;
use Braintree;

class UserDevicesController extends Controller
{
    public function saveUserActivies(Request $request)
    {
        $data = $request->all();
        $record = UserDevices::where('jobseeker_id', $data['jobseeker_id'])
            ->where('jobs_id', $data['jobs_id'])
            ->where('activity_type', 'Call')
            ->first();
        if ($record) {
            $record->update($data);
        } else {
            UserDevices::create($data);
        }

        $status_code = 200;
        $message = "save successfully";
        return comman_message_response($message, $status_code);
    }
}
