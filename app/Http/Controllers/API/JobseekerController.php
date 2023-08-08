<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class JobseekerController extends Controller
{


    public function getJobseekerDetailsByEducation(Request $request)
    {
        $id = $request->education;


        $user = User::select('users.id', 'username', 'first_name', 'last_name', 'email',  'contact_number', 'display_name',  'address', 'details', 'cities.name as city')
            ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
            ->where('users.id', $id)
            ->first();

        $message = __('messages.detail');
        if (empty($user)) {
            $message = __('messages.user_not_found');
            return comman_message_response($message, 400);
        }

        $user['profile_image'] = getSingleMedia($user, 'profile_image', null);
        $user['resume'] = getSingleMedia($user, 'resume', null);
        // $user['en_city_name'] = $user->city->name;

        $response = $user;
        return comman_custom_response($response, 200);
    }

  




 

 
}
