<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Http\Requests\UserRequest;
use Validator;
use Hash;
use Auth;
use App\Http\Resources\API\UserResource;
use App\Http\Resources\API\ServiceResource;
use Illuminate\Support\Facades\Password;
use App\Models\Booking;
use App\Models\ProviderDocument;
use App\Models\Documents;
use App\Models\UserDevices;
use App\Models\HandymanRating;
use App\Models\ProviderSubscription;
use App\Models\BookingHandymanMapping;
use App\Http\Resources\API\HandymanRatingResource;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $input = $request->all();

        $password = $input['password'];
        $input['display_name'] = $input['first_name'] . " " . $input['last_name'];
        $input['user_type'] = isset($input['user_type']) ? $input['user_type'] : 'user';
        $input['password'] = Hash::make($password);

        if (in_array($input['user_type'], ['handyman', 'provider'])) {
            $input['status'] = isset($input['status']) ? $input['status'] : 0;
        }
        $user = User::create($input);
        $user->assignRole($input['user_type']);
        $input['api_token'] = $user->createToken('auth_token')->plainTextToken;

        unset($input['password']);
        $message = trans('messages.save_form', ['form' => $input['user_type']]);
        $user->api_token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'message' => $message,
            'data' => $user
        ];
        return comman_custom_response($response);
    }



    public function login(UserRequest $request)
    {

        if ($request->is('api/*')) {

            $input = $request->all();
            if ($input['user_type'] == 'handyman') {
                $user = User::where('email', $input['email'])->where('user_type', 'handyman')->first();
            } else {
                $user = User::where('email', $input['email'])->where('user_type', 'provider')->first();
            }
            if ($user && Hash::check($input['password'], $user->password)) {

                if (request('player_id') != null) {
                    $user->player_id = request('player_id');
                    $user->save();
                }
                $success = $user;
                $success['user_role'] = $user->getRoleNames();
                $success['api_token'] = $user->createToken('auth_token')->plainTextToken;
                $success['profile_image'] = getSingleMedia($user, 'profile_image', null);
                $is_verify_provider = false;

                if ($user->user_type == 'provider') {
                    $is_verify_provider = verify_provider_document($user->id);
                    $success['subscription'] = get_user_active_plan($user->id);

                    if (is_any_plan_active($user->id) == 0 && $success['is_subscribe'] == 0) {
                        $success['subscription'] = user_last_plan($user->id);
                    }
                    $success['is_subscribe'] = is_subscribed_user($user->id);
                }
                $success['is_verify_provider'] = (int) $is_verify_provider;
                unset($success['media']);
                unset($user['roles']);

                return response()->json(['data' => $success], 200);
            } else {

                $message = trans('auth.failed');

                return comman_message_response($message, 400);
            }
        } else {

            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

                $user = Auth::user();
                if (request('loginfrom') === 'vue-app') {
                    if ($user->user_type != 'user') {
                        $message = trans('auth.not_able_login');
                        return comman_message_response($message, 400);
                    }
                }
                if (request('player_id') != null) {
                    $user->player_id = request('player_id');
                }
                $user->save();

                $success = $user;
                $success['user_role'] = $user->getRoleNames();
                $success['api_token'] = $user->createToken('auth_token')->plainTextToken;
                $success['profile_image'] = getSingleMedia($user, 'profile_image', null);
                $is_verify_provider = false;

                if ($user->user_type == 'provider') {
                    $is_verify_provider = verify_provider_document($user->id);
                    $success['subscription'] = get_user_active_plan($user->id);

                    if (is_any_plan_active($user->id) == 0 && $success['is_subscribe'] == 0) {
                        $success['subscription'] = user_last_plan($user->id);
                    }
                    $success['is_subscribe'] = is_subscribed_user($user->id);
                }
                $success['is_verify_provider'] = (int) $is_verify_provider;
                unset($success['media']);
                unset($user['roles']);

                return response()->json(['data' => $success], 200);
            } else {

                $message = trans('auth.failed');

                return comman_message_response($message, 400);
            }
        }
    }

    public function userList(Request $request)
    {
        $user_type = isset($request['user_type']) ? $request['user_type'] : 'handyman';
        if (default_earning_type() === 'subscription' && $user_type == 'provider') {
            $handyman_list = User::orderBy('id', 'desc')->where('user_type', $user_type)->where('status', 1)->where('is_subscribe', 1);
        } else {
            $handyman_list = User::orderBy('id', 'desc')->where('user_type', $user_type)->where('status', 1);
        }
        if ($user_type == 'handyman') {
            $handyman_list = User::orderBy('id', 'desc')->where('user_type', $user_type);
        }
        if (auth()->user() !== null) {
            if (auth()->user()->hasRole('admin')) {
                $handyman_list = User::orderBy('id', 'desc')->where('user_type', $user_type)->withTrashed();
            }
        }

        if ($request->has('provider_id')) {
            $handyman_list = $handyman_list->where('provider_id', $request->provider_id);
        }
        if ($request->has('city_id') && !empty($request->city_id)) {
            $handyman_list = $handyman_list->where('city_id', $request->city_id);
        }
        if ($request->has('status') && isset($request->status)) {
            $handyman_list = $handyman_list->where('status', $request->status);
        }
        if ($request->has('keyword') && isset($request->keyword)) {
            $handyman_list = $handyman_list->where('display_name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->has('booking_id')) {
            $booking_data = Booking::find($request->booking_id);

            $service_address = $booking_data->handymanByAddress;
            if ($service_address != null) {
                $handyman_list = $handyman_list->where('service_address_id', $service_address->id);
            }
        }
        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $handyman_list->count();
            }
        }

        $user_list = $handyman_list->paginate($per_page);

        $items = UserResource::collection($user_list);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);
    }

    public function userDetail(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);
        $message = __('messages.detail');
        if (empty($user)) {
            $message = __('messages.user_not_found');
            return comman_message_response($message, 400);
        }

        $service = [];
        $handyman_rating = [];

        if ($user->user_type == 'provider') {
            $service = Service::where('provider_id', $id)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
            $service = ServiceResource::collection($service);
            $handyman_rating = HandymanRating::where('handyman_id', $id)->orderBy('id', 'desc')->paginate(10);
            $handyman_rating = HandymanRatingResource::collection($handyman_rating);
        }
        $user_detail = new UserResource($user);
        if ($user->user_type == 'handyman') {
            $handyman_rating = HandymanRating::where('handyman_id', $id)->orderBy('id', 'desc')->paginate(10);
            $handyman_rating = HandymanRatingResource::collection($handyman_rating);
        }

        $response = [
            'data' => $user_detail,
            'service' => $service,
            'handyman_rating_review' => $handyman_rating
        ];
        return comman_custom_response($response);
    }

    public function jobseekerDetails(Request $request)
    {
        $id = $request->id;


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

    public function changePassword(Request $request)
    {
        $user = User::where('id', \Auth::user()->id)->first();

        if ($user == "") {
            $message = __('messages.user_not_found');
            return comman_message_response($message, 400);
        }

        $hashedPassword = $user->password;

        $match = Hash::check($request->old_password, $hashedPassword);

        $same_exits = Hash::check($request->new_password, $hashedPassword);
        if ($match) {
            if ($same_exits) {
                $message = __('messages.old_new_pass_same');
                return comman_message_response($message, 400);
            }

            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            $message = __('messages.password_change');
            return comman_message_response($message, 200);
        } else {
            $message = __('messages.valid_password');
            return comman_message_response($message);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = \Auth::user();
        if ($request->has('id') && !empty($request->id)) {
            $user = User::where('id', $request->id)->first();
        }
        if ($user == null) {
            return comman_message_response(__('messages.no_record_found'), 400);
        }

        $user->fill($request->all())->update();

        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        $user_data = User::find($user->id);

        $message = __('messages.updated');
        $user_data['profile_image'] = getSingleMedia($user_data, 'profile_image', null);
        $user_data['user_role'] = $user->getRoleNames();
        unset($user_data['roles']);
        unset($user_data['media']);
        $response = [
            'data' => $user_data,
            'message' => $message
        ];
        return comman_custom_response($response);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($request->is('api*')) {
            $user->player_id = null;
            $user->save();
            return comman_message_response('Logout successfully');
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => __($response), 'status' => true], 200)
            : response()->json(['message' => __($response), 'status' => false], 400);
    }



    public function socialLogin(Request $request)
    {
        $input = $request->all();


        if ($input['user_type'] === 'user') {
            $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'user')->first();
        }
        // if ($input['user_type'] === 'provider') {
        //     $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'provider')->first();
        // }
        // if ($input['user_type'] === 'jobs') {
        //     $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'jobs')->first();
        // }
        // if ($input['user_type'] == 'jobseeker') {
        //     $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'jobseeker')->first();
        // }

        // if ($input['login_type'] === 'mobile') {
        //     $user_data = User::where('username', $input['username'])->where('login_type', 'mobile')->first();
        // } else {
        //     $user_data = User::where('email', $input['email'])->first();


        // }


        if ($user_data != null) {
            if (!isset($user_data->login_type) || $user_data->login_type  == '') {
                if ($request->login_type === 'google') {
                    $message = __('validation.unique', ['attribute' => 'email']);
                } else {
                    $message = __('validation.unique', ['attribute' => 'username']);
                }
                return comman_message_response($message, 400);
            }
            $message = __('messages.login_success');
        } else {

            if ($request->login_type === 'google') {
                $key = 'email';
                $value = $request->email;
            } else {
                $key = 'contact_number';
                $value = $request->username;
            }

            $trashed_user_data = User::where($key, $value)->whereNotNull('login_type')->withTrashed()->first();

            // if ($trashed_user_data != null && $trashed_user_data->trashed()) {
            //     if ($request->login_type === 'google') {
            //         $message = __('validation.unique', ['attribute' => 'email']);
            //     } else {
            //         $message = __('validation.unique', ['attribute' => 'username']);
            //     }
            //     return comman_message_response($message, 400);
            // }

            if ($request->login_type === 'mobile' && $user_data == null) {
                $otp_response = [
                    'status' => true,
                    'is_user_exist' => false
                ];
                return comman_custom_response($otp_response);
            }
            if ($request->login_type === 'mobile' && $user_data != null) {
                $otp_response = [
                    'status' => true,
                    'is_user_exist' => true
                ];
                return comman_custom_response($otp_response);
            }

            $password = !empty($input['accessToken']) ? $input['accessToken'] : $input['email'];

            $input['user_type']  = "user";
            $input['display_name'] = $input['first_name'] . " " . $input['last_name'];
            $input['password'] = Hash::make($password);
            $input['user_type'] = isset($input['user_type']) ? $input['user_type'] : 'user';
            $user = User::create($input);
            $user->assignRole($input['user_type']);

            $user_data = User::where('id', $user->id)->first();
            $message = trans('messages.save_form', ['form' => $input['user_type']]);
        }
        $user_data['api_token'] = $user_data->createToken('auth_token')->plainTextToken;
        $user_data['profile_image'] = $user_data->social_image;
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $user_data
        ];
        return comman_custom_response($response);
    }

    public function userStatusUpdate(Request $request)
    {
        $user_id =  $request->id;
        $user = User::where('id', $user_id)->first();

        if ($user == "") {
            $message = __('messages.user_not_found');
            return comman_message_response($message, 400);
        }
        $user->status = $request->status;
        $user->save();

        $message = __('messages.update_form', ['form' => __('messages.status')]);
        $response = [
            'data' => new UserResource($user),
            'message' => $message
        ];
        return comman_custom_response($response);
    }
    public function contactUs(Request $request)
    {
        try {
            \Mail::send(
                'contactus.contact_email',
                array(
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'subject' => $request->get('subject'),
                    'phone_no' => $request->get('phone_no'),
                    'user_message' => $request->get('user_message'),
                ),
                function ($message) use ($request) {
                    $message->from($request->email);
                    $message->to(env('MAIL_FROM_ADDRESS'));
                }
            );
            $messagedata = __('messages.contact_us_greetings');
            return comman_message_response($messagedata);
        } catch (\Throwable $th) {
            $messagedata = __('messages.something_wrong');
            return comman_message_response($messagedata);
        }
    }
    public function handymanAvailable(Request $request)
    {
        $user_id =  $request->id;
        $user = User::where('id', $user_id)->first();

        if ($user == "") {
            $message = __('messages.user_not_found');
            return comman_message_response($message, 400);
        }
        $user->is_available = $request->is_available;
        $user->save();

        $message = __('messages.update_form', ['form' => __('messages.status')]);
        $response = [
            'data' => new UserResource($user),
            'message' => $message
        ];
        return comman_custom_response($response);
    }

    public function jobUserAvailable(Request $request)
    {
        $user_id =  $request->id;
        $user = User::where('id', $user_id)->first();

        if ($user == "") {
            $message = __('messages.user_not_found');
            return comman_message_response($message, 400);
        }
        $user->is_available = $request->is_available;
        $user->save();

        $message = __('messages.update_form', ['form' => __('messages.status')]);
        $response = [
            'data' => new UserResource($user),
            'message' => $message
        ];
        return comman_custom_response($response);
    }
    public function handymanReviewsList(Request $request)
    {
        $id = $request->handyman_id;
        $handyman_rating_data = HandymanRating::where('handyman_id', $id);

        $per_page = config('constant.PER_PAGE_LIMIT');

        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $handyman_rating_data->count();
            }
        }

        $handyman_rating_data = $handyman_rating_data->orderBy('created_at', 'desc')->paginate($per_page);

        $items = HandymanRatingResource::collection($handyman_rating_data);
        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];
        return comman_custom_response($response);
    }
    public function deleteJobsAccount(Request $request)
    {
        $input = $request->all();
        $user = User::where('id', $input['user_id'])->where('user_type', 'jobs')->first();
        if ($user == null) {
            $message = __('messages.user_not_found');
            __('messages.msg_fail_to_delete', ['item' => __('messages.user')]);
            return comman_message_response($message, 400);
        }

        $user->delete();
        $message = __('messages.msg_deleted', ['name' => __('messages.user')]);
        return comman_message_response($message, 200);
    }

    public function deleteUserAccount(Request $request)
    {
        $user_id = \Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user == null) {
            $message = __('messages.user_not_found');
            __('messages.msg_fail_to_delete', ['item' => __('messages.user')]);
            return comman_message_response($message, 400);
        }
        $user->booking()->forceDelete();
        $user->payment()->forceDelete();
        $user->forceDelete();
        $message = __('messages.msg_deleted', ['name' => __('messages.user')]);
        return comman_message_response($message, 200);
    }
    public function deleteAccount(Request $request)
    {
        $user_id = \Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user == null) {
            $message = __('messages.user_not_found');
            __('messages.msg_fail_to_delete', ['item' => __('messages.user')]);
            return comman_message_response($message, 400);
        }
        if ($user->user_type == 'provider') {
            if ($user->providerPendingBooking()->count() == 0) {
                $user->providerService()->forceDelete();
                $user->providerPendingBooking()->forceDelete();
                $provider_handyman = User::where('provider_id', $user_id)->get();
                if (count($provider_handyman) > 0) {
                    foreach ($provider_handyman as $key => $value) {
                        $value->provider_id = NULL;
                        $value->update();
                    }
                }
                $user->forceDelete();
            } else {
                $message = __('messages.pending_booking');
                return comman_message_response($message, 400);
            }
        } else {
            if ($user->handymanPendingBooking()->count() == 0) {
                $user->handymanPendingBooking()->forceDelete();
                $user->forceDelete();
            } else {
                $message = __('messages.pending_booking');
                return comman_message_response($message, 400);
            }
        }
        $message = __('messages.msg_deleted', ['name' => __('messages.user')]);
        return comman_message_response($message, 200);
    }
    public function addUser(UserRequest $request)
    {
        $input = $request->all();

        $password = $input['password'];

        $input['display_name'] = $input['first_name'] . " " . $input['last_name'];
        $input['user_type'] = isset($input['user_type']) ? $input['user_type'] : 'user';
        $input['password'] = Hash::make($password);

        if ($input['user_type'] === 'provider') {
        }
        $user = User::create($input);
        $user->assignRole($input['user_type']);
        $input['api_token'] = $user->createToken('auth_token')->plainTextToken;

        unset($input['password']);
        $message = trans('messages.save_form', ['form' => $input['user_type']]);
        $user->api_token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'message' => $message,
            'data' => $user
        ];
        return comman_custom_response($response);
    }
    public function uploadResume(UserRequest $request)
    {

        if ($request->has('id') && !empty($request->id)) {

            $user = User::find((int)$request->id);
        }
        if ($user == null) {
            return comman_message_response(__('messages.no_record_found'), 400);
        }

        $user->fill($request->all())->update();
        if (isset($request->resume) && $request->resume != null) {
            $user->clearMediaCollection('resume');
            $user->addMediaFromRequest('resume')->toMediaCollection('resume');
        }
        $response = [
            'status' => true,
        ];

        return comman_custom_response($response, 200);
    }
    public function editUser(UserRequest $request)
    {
        if ($request->has('id') && !empty($request->id)) {
            $user = User::where('id', $request->id)->first();
        }
        if ($user == null) {
            return comman_message_response(__('messages.no_record_found'), 400);
        }

        $details = [
            'martial_status' => $request->martial_status,
            'dob' => $request->dob,
            'experience' => $request->experience,
            'education'  => $request->education,
            'gender'     => $request->gender,
            'category_name' => $request->category_name,
            'job_category' => $request->job_category,
            'districts' => $request->districts
        ];

        $user->details = json_encode($details);

        $user->fill($request->all())->update();

        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        if (isset($request->resume) && $request->resume != null) {
            $user->clearMediaCollection('resume');
            $user->addMediaFromRequest('resume')->toMediaCollection('resume');
        }

        $user_data = User::find($user->id);

        $message = __('messages.updated');
        $user_data['profile_image'] = getSingleMedia($user_data, 'profile_image', null);
        if ($request->user_type == "jobseeker") {

            $user_data['resume'] = getSingleMedia($user_data, 'resume', null);
        } else if ($request->user_type == "jobs") {

            $user_data['companies'] = $user_data->companies;
        }
        $user_data['user_role'] = $user->getRoleNames();
        unset($user_data['roles']);
        unset($user_data['media']);
        $response = [
            'data' => $user_data,
            'message' => $message
        ];
        return comman_custom_response($response);
    }

    public function trueCallerLogin(Request $request)
    {
        $input = $request->all();
        $user = \Auth::user();
        if (request('contact_number') != '') {

            if ($input['user_type'] === 'user') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'user')->first();
            }
            if ($input['user_type'] === 'provider') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'provider')->first();
            }
            if ($input['user_type'] === 'jobs') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'jobs')->first();
            }
            if ($input['user_type'] == 'jobseeker') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'jobseeker')->first();
            }


            if ($user_data == null) {
                $input['username'] = $input['contact_number'];

                $input['password'] = '';
                $user = User::create($input);
                $user->assignRole($input['user_type']);
                $details = [
                    'martial_status' => "",
                    'dob' => $request->dob,
                    'experience' => "",
                    'education'  => "",
                    'gender'     => $request->gender,
                    'category_name' => "",
                    'job_category' => "",
                    'districts' => ""
                ];

                $user->details = json_encode($details);
                $result = $user->save();
                $success = $user->toArray();
                $success['user_role'] = $user->getRoleNames();
                $success['api_token'] = $user->createToken('auth_token')->plainTextToken;
                $success['profile_image'] =  $user->social_image;
                $is_verify_provider = false;
                $success['is_verify_provider'] = (int) $is_verify_provider;
                unset($success['media']);
                unset($user['roles']);
                $otp_response = [
                    'status' => true,
                    "otp_status" => true,
                    "data" => $success
                ];
                return comman_custom_response($otp_response, 200);
            }
            if ($user_data != null) {
                $input['password'] = '';
                $user_data->assignRole($input['user_type']);
                $user_data->update($input);

                $success = $user_data;

                $success['user_role'] = $user_data->getRoleNames();

                if ($request->user_type == "jobseeker") {

                    $user_data['resume'] = getSingleMedia($user_data, 'resume', null);
                } else if ($request->user_type == "jobs") {

                    $user_data['companies'] = $user_data->companies;
                }

                $success['api_token'] = $user_data->createToken('auth_token')->plainTextToken;
                $success['profile_image'] =  $user_data->social_image;
                unset($success['media']);
                unset($user_data['roles']);

                $otp_response = [
                    'status' => true,
                    "otp_status" => true,
                    "data" => $success
                ];

                return comman_custom_response($otp_response, 200);
            }
        } else {
            $message = trans('auth.failed');

            return comman_message_response($message, 400);
        }
    }
    public function mobileLogin(Request $request)
    {
        $input = $request->all();

        $signCode = "xhhw9DtWc9R";

        if (isset($input['sign_code'])) {
            $signCode = $input['sign_code'];
        }

        if ($input['contact_number'] == '9876543210') {

            $otp_response = [
                'status' => true,
                'is_user_valid' => true,
                'sms_sent' => true
            ];
            return comman_custom_response($otp_response, 200);
        } else {

            $input['username'] = $input['contact_number'];
            $input['first_name'] = '';
            $input['password'] = '';
            $user = \Auth::user();
            if ($input['user_type'] === 'user') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', $input['user_type'])->first();
            }
            if ($input['user_type'] === 'provider') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', $input['user_type'])->first();
            }
            if ($input['user_type'] == 'jobs') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', $input['user_type'])->first();
            }

            if ($input['user_type'] == 'jobseeker') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', $input['user_type'])->first();
            }


            if ($user_data == null) {
                $user = User::create($input);
                $user->assignRole($input['user_type']);

                if (request('player_id') != null) {
                    $user->player_id = request('player_id');
                }

                $fourRandomDigit = rand(1000, 9999);

                $smsReply = $this->sentSMS($input['contact_number'],  $fourRandomDigit, $signCode);

                if ($smsReply['status'] == 'Success') {

                    $user->otp = $fourRandomDigit;
                    $user->save();
                    if (isset($input['device_token'])) {
                        $device = UserDevices::firstOrCreate(['user_id' => $user->id]);
                        $device->device_token = $input['device_token'];
                        $device->save();
                    }
                    $otp_response = [
                        'status' => true,
                        'is_user_valid' => true,
                        'sms_sent' => true
                    ];
                    return comman_custom_response($otp_response, 200);
                } else {

                    $otp_response = [
                        'status' => true,
                        'is_user_valid' => true,
                        'sms_sent' => false
                    ];

                    return comman_custom_response($otp_response, 400);
                }
            }
            if ($user_data != null) {

                if ($user_data->login_attempts <= 15) {

                    $fourRandomDigit = rand(1000, 9999);
                    $user_data->otp = $fourRandomDigit;

                    $smsReply = $this->sentSMS($input['contact_number'],  $fourRandomDigit, $signCode);
                    if ($smsReply['status'] == 'Success') {
                        $user_data->deleted_at = null;
                        $user_data->login_attempts = $user_data->login_attempts + 1;
                        $user_data->update();

                        if (isset($input['device_token'])) {
                            $device = UserDevices::firstOrCreate(['user_id' => $user_data->id]);
                            $device->device_token = $input['device_token'];
                            $device->save();
                        }


                        $otp_response = [
                            'status' => true,
                            'is_user_exist' => true,
                            'sms_sent' => true
                        ];
                        return comman_custom_response($otp_response, 200);
                    } else {

                        $otp_response = [
                            'status' => true,
                            'is_user_exist' => true,
                            'sms_sent' => false
                        ];
                        return comman_custom_response($otp_response, 400);
                    }
                } else {

                    if ($this->checkLoginAttempts($user_data->updated_at)) {
                        $otp_response = [
                            'status' => true,
                            'is_user_valid' => false,
                            'sms_sent' => false,
                            'data' => "Maximum otp attempts, Try again login later"
                        ];
                        return comman_custom_response($otp_response, 400);
                    } else {
                        $fourRandomDigit = rand(1000, 9999);
                        $user_data->otp = $fourRandomDigit;
                        $smsReply = $this->sentSMS($input['contact_number'],  $fourRandomDigit, $signCode);
                        if ($smsReply['status'] == 'Success') {
                            $user_data->login_attempts = 0;
                            $user_data->update();

                            if (isset($input['device_token'])) {
                                $device = UserDevices::firstOrCreate(['user_id' => $user->id]);
                                $device->device_token = $input['device_token'];
                                $device->save();
                            }
                            $otp_response = [
                                'status' => true,
                                'is_user_exist' => true,
                                'sms_sent' => true
                            ];
                            return comman_custom_response($otp_response, 200);
                        } else {
                            $otp_response = [
                                'status' => true,
                                'is_user_exist' => true,
                                'sms_sent' => false
                            ];
                            return comman_custom_response($otp_response, 400);
                        }
                    }
                }
            }
        }
    }
    public function verifyOtp(Request $request)
    {
        $input = $request->all();

        $user = \Auth::user();

        if (request('contact_number') != '' && request('otp') != '') {

            if ($input['user_type'] === 'user') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'user')->first();
            }
            if ($input['user_type'] === 'provider') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'provider')->first();
            }
            if ($input['user_type'] === 'jobs') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'jobs')->first();
            }
            if ($input['user_type'] == 'jobseeker') {
                $user_data = User::where('contact_number', $input['contact_number'])->where('user_type', 'jobseeker')->first();
            }


            if ($user_data == null) {

                $otp_response = [
                    'status' => true,
                    "otp_status" => false,
                    "message" => "Invalid phone number or Access"

                ];

                return comman_custom_response($otp_response);
            }
            if ($user_data != null) {


                if ($user_data->otp === 0 || $user_data->otp === '0' || $user_data->otp === '0000') {

                    $otp_response = [
                        'status' => true,
                        "otp_status" => false,
                        "data" => "Invalid OTP"
                    ];

                    return comman_custom_response($otp_response, 400);
                }
                if ($user_data->otp ==  $input['otp'] && $user_data->otp == '1133') {

                    $success = $user_data;

                    $user_data->login_attempts = 0;
                    $user_data->update();
                    $success['user_role'] = $user_data->getRoleNames();
                    $user_data['companies'] = [];
                    $success['api_token'] = $user_data->createToken('auth_token')->plainTextToken;
                    $success['profile_image'] = getSingleMedia($user_data, 'profile_image', null);
                    $is_verify_provider = false;
                    $success['is_verify_provider'] = (int) $is_verify_provider;
                    unset($success['media']);
                    unset($user_data['roles']);

                    $otp_response = [
                        'status' => true,
                        "otp_status" => true,
                        "data" => $success
                    ];

                    return comman_custom_response($otp_response, 200);
                } else {

                    if ($user_data->otp ==  $input['otp'] && $user_data->otp != null) {
                        $success = $user_data;
                        //$user_data->otp = 1111;
                        $user_data->login_attempts = 0;
                        $user_data->update();
                        $success['user_role'] = $user_data->getRoleNames();

                        if ($request->user_type == "jobseeker") {

                            $user_data['resume'] = getSingleMedia($user_data, 'resume', null);
                        } else if ($request->user_type == "jobs") {

                            $user_data['companies'] = $user_data->companies;
                        }

                        $success['api_token'] = $user_data->createToken('auth_token')->plainTextToken;
                        $success['profile_image'] = getSingleMedia($user_data, 'profile_image', null);
                        $is_verify_provider = false;
                        if ($user_data->user_type == 'provider') {
                            $is_verify_provider = verify_provider_document($user_data->id);
                            $success['subscription'] = get_user_active_plan($user_data->id);

                            if (is_any_plan_active($user_data->id) == 0 && $success['is_subscribe'] == 0) {
                                $success['subscription'] = user_last_plan($user_data->id);
                            }
                            $success['is_subscribe'] = is_subscribed_user($user_data->id);
                        }
                        $success['is_verify_provider'] = (int) $is_verify_provider;
                        unset($success['media']);
                        unset($user_data['roles']);

                        $otp_response = [
                            'status' => true,
                            "otp_status" => true,
                            "data" => $success
                        ];

                        return comman_custom_response($otp_response, 200);
                    } else {

                        $otp_response = [
                            'status' => true,
                            "otp_status" => false,
                            "data" => "Invalid OTP"
                        ];

                        return comman_custom_response($otp_response, 400);
                    }
                }
            }
        } else {
            $message = trans('auth.failed');

            return comman_message_response($message, 400);
        }
    }

    private function checkAndResetOtp($updatedAt)
    {
        // Set the OTP expiration time (30 minutes in seconds)
        $otpExpirationTime = 30 * 60;

        // Convert the updated_at timestamp to a DateTime object
        $updatedAtDateTime = new \DateTime($updatedAt);

        // Get the current time as a DateTime object
        $currentDateTime = new \DateTime();

        // Calculate the difference between the current time and the updated_at time
        $timeDifference = $currentDateTime->getTimestamp() - $updatedAtDateTime->getTimestamp();

        // Check if the OTP is expired
        if ($timeDifference > $otpExpirationTime) {
            // Reset the OTP
            return false;

            //echo "The OTP has expired and has been reset.\n";
        } else {
            return true;
            //echo "The OTP is still valid.\n";
            exit();
        }
    }

    private function checkLoginAttempts($updatedAt)
    {
        // Set the OTP expiration time (30 minutes in seconds)
        $otpExpirationTime = 30 * 60;

        // Convert the updated_at timestamp to a DateTime object
        $updatedAtDateTime = new \DateTime($updatedAt);

        // Get the current time as a DateTime object
        $currentDateTime = new \DateTime();

        // Calculate the difference between the current time and the updated_at time
        $timeDifference = $currentDateTime->getTimestamp() - $updatedAtDateTime->getTimestamp();

        // Check if the OTP is expired
        if ($timeDifference > $otpExpirationTime) {
            // Reset the OTP
            return false;

            //echo "The OTP has expired and has been reset.\n";
        } else {
            return true;
            //echo "The OTP is still valid.\n";
            exit();
        }
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }



    private function sentSMS($contacts, $otp, $signCode)
    {


        // $api_key = 'ca2b0f99-5cea-4447-9635-b2d94b0c81a3';
        // $ClientId ="c5aa5dc4-e92f-43de-90a0-3d20807162d8";
        // $id = 'XTTECH';
        // $sms_text = "Welcome to XTTECH Dear jobs7 your OTP is $otp";
        // date_default_timezone_set("Asia/Calcutta");
        // $newtimestamp = strtotime(date('Y-m-d H:i:s').'+1 minute');
        // $dateTime = date('Y-m-d H:i:s', $newtimestamp);

        // $api_url = str_replace(' ', '+', "https://sms.nettyfish.com/api/v2/SendSMS?ApiKey=$api_key&ClientId=$ClientId&SenderId=$id&Message=$sms_text&MobileNumbers=$contacts&Is_Unicode=true&Is_Flash=true&SchedTime=$dateTime");

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        // CURLOPT_RETURNTRANSFER => 1,
        // CURLOPT_URL => $api_url

        // ));
        // $Response = curl_exec($curl);
        // $retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // if ($retcode == 200) {
        //     return true;
        // } else {
        //    return false;

        // }
        // curl_close($curl);
        // Account details

        #################################################################################################################
        // $apiKey = urlencode('NzQ0NDQ2NDk2YTU0Mzc0MTc1MzY0ZDU2NDg1NjU1Mzc=');

        // // Message details
        // $numbers = array($contacts);
        // $sender = urlencode('TAMLAN');


        // $message = rawurlencode($otp . ' is your OTP to verify your mobile number on the Jobs7 app/website.' . $signCode);

        // $numbers = implode(',', $numbers);

        // //  Prepare data for POST request
        // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        // // Send the POST request with cURL
        // $ch = curl_init('https://api.textlocal.in/send/');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
        // curl_close($ch);

        // $res = json_decode($response);


        // if ($res->status == 'success') {
        //     return $data['status'] = "Success";
        // } else {
        //     return $data['status'] = "Failure";
        // }


        // exit();
        //----------------------------------------------------sms my dream----------------------------------------------------------- 

        // $key = "gIzOiWdbFTqrCWVq";
        // $mbl = $contacts;     /*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
        // //$message_content=urlencode(''.$otp.' is your OTP to verify your mobile number on the Jobs7 app/website. '.$org);
        // $message_content = urlencode($otp . ' is your verification code for Tamilanjobs - Find Jobs Locally. ' . $signCode);

        // $senderid = "TAMLAN";

        // $url = "http://app.mydreamstechnology.in/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content";

        // $output = file_get_contents($url);    /*default function for push any url*/

        // return json_decode($output, true);
        // exit();

        //return json_decode($output, true);   
        //return [
        //  'status' => 'Success',
        // 'message' => 'Please Enter Valid OTP for login'

        // ];
        //----------------------------------------------------sms eagleminds tech----------------------------------------------------------- 
        $key = "nPD1MSa7HP0NczP0";
        $mbl = $contacts;     /*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
        // //$message_content=urlencode(''.$otp.' is your OTP to verify your mobile number on the Jobs7 app/website. '.$org);
        $message_content = urlencode($otp . ' is your verification code for Tamilanjobs - Find Jobs Locally. ' . $signCode);

        $senderid = "TAMLAN";

        $url = "https://sms.eagleminds.net/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content";

        $output = file_get_contents($url);    /*default function for push any url*/

        return json_decode($output, true);
        exit();
    }
}
