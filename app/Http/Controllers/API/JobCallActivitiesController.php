<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCallActivities;


class JobCallActivitiesController extends Controller
{
    public function saveCallActivities(Request $request)
    {
        $data = $request->all();
     
        $data['datetime'] = isset($request->datetime) ? date('Y-m-d H:i:s', strtotime($request->datetime)) : date('Y-m-d H:i:s');
        if($data['jobseeker_id'] != ""){
            JobCallActivities::updateOrCreate(['jobseeker_id' => $data['jobseeker_id']], $data);
        }
        else{
            JobCallActivities::create($data);

        }
     
        

        $status_code = 200;

        $message = "save successfully";

        return comman_message_response($message, $status_code);
    }
}
