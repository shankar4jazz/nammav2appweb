<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\JobseekerDataTable;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Http\Requests\UserRequest;

class JobseekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobseekerDataTable $dataTable)
    {
        $pageTitle = __('messages.list_form_title', ['form' => __('messages.user')]);
        $assets = ['datatable'];
        $auth_user = authSession();
        $providerdata = [];
        $earningData = [];

        $totalJobseekers = $dataTable->getTotalJobseekers();
        $totalMale = isset($totalJobseekers['Male']) ? $totalJobseekers['Male'] : 0;
        $totalFemale = isset($totalJobseekers['Female']) ? $totalJobseekers['Female'] : 0;
        $totalOther = isset($totalJobseekers['Other']) ? $totalJobseekers['Other'] : 0;
        $totalNULL = isset($totalJobseekers['Null']) ? $totalJobseekers['Null'] : 0;

        $totalCounts = [
            'Male' => $totalMale,
            'Female' => $totalFemale,
            'Other' => $totalOther,
            'NULL' => $totalNULL,
            'Total' => $totalMale + $totalFemale + $totalOther
        ];


        $totalJobseekers = $dataTable->getTotalJobseekers();
        return $dataTable->render('jobseeker.index', compact('pageTitle', 'assets', 'auth_user',  'providerdata', 'auth_user', 'earningData', 'totalCounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $auth_user = authSession();

        $customerdata = User::find($id);
        $pageTitle = __('messages.update_form_title', ['form' => __('messages.user')]);

        if ($customerdata == null) {
            $pageTitle = __('messages.add_button_form', ['form' => __('messages.user')]);
            $customerdata = new User;
        }

        return view('customer.create', compact('pageTitle', 'customerdata', 'auth_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $data = $request->all();
        $id = $data['id'];
        $data['user_type'] = $data['user_type'] ?? 'user';


        $data['display_name'] = $data['first_name'] . " " . $data['last_name'];
        // Save User data...
        if ($id == null) {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
        } else {
            $user = User::findOrFail($id);

            $districts = $data['districts'];
            $formattedDistricts = array_map(function ($district) {
                return ['id' => (int) $district];
            }, $districts);


            $jobcat = $data['job_categories'];
            $formattedJobCat = array_map(function ($district) {
                return ['id' => (int) $district];
            }, $jobcat);


            $data['districts'] = json_encode($formattedDistricts);
            $data['job_categories'] = json_encode($formattedJobCat);

            $user->removeRole($user->user_type);
            $user->fill($data)->update();
        }
        $user->assignRole($data['user_type']);
        $message = __('messages.update_form', ['form' => __('messages.user')]);
        if ($user->wasRecentlyCreated) {
            $message = __('messages.save_form', ['form' => __('messages.user')]);
        }

        return redirect('jobseeker/'.$id)->withSuccess($message);
    }


    public function quickCreate(Request $request)
    {

        $id = $request->id;


        $auth_user = authSession();

        $data = $request->all();


        $customerdata = User::find($id);
        $pageTitle = __('messages.update_form_title', ['form' => __('messages.user')]);

        if ($customerdata == null) {
            $pageTitle = __('messages.add_button_form', ['form' => __('messages.user')]);
            $customerdata = new User;
            $customerdata['contact_number'] = $data['mobile_no'];
            $customerdata['type'] = $data['type'];
        }

        return view('customer.quickcreate', compact('pageTitle', 'customerdata', 'auth_user'));
    }


    public function quickStore(UserRequest $request)
    {
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $data = $request->all();
        $id = $data['id'];
        $data['user_type'] = $data['user_type'] ?? 'user';

        $data['display_name'] = $data['first_name'];
        $data['username'] = $data['first_name'];

        if ($id == null) {
            $data['password'] = bcrypt($data['contact_number']);
            $user = User::create($data);
        } else {
            $user = User::findOrFail($id);
            // User data...
            $user->removeRole($user->user_type);
            $user->fill($data)->update();
        }

        $user->assignRole($data['user_type']);
        $message = __('messages.update_form', ['form' => __('messages.user')]);
        if ($user->wasRecentlyCreated) {
            $message = __('messages.save_form', ['form' => __('messages.user')]);
        }

        if ($data['type'] == 'booking') {

            return redirect(route('booking.addquick', ['mobile_no' => $data['contact_number'], 'user_type' => $data['user_type']]))->withSuccess($message);
        }
        if ($data['type'] == 'jobs') {
            return redirect(route('jobs.jobadd', ['mobile_no' => $data['contact_number'], 'user_type' => $data['user_type']]))->withSuccess($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_user = authSession();
        $customerdata = User::find($id);
        if (empty($customerdata)) {
            $msg = __('messages.not_found_entry', ['name' => __('messages.user')]);
            return redirect(route('jobseeker.index'))->withError($msg);
        }
        $customer_pending_trans  = Payment::where('customer_id', $id)->where('payment_status', 'pending')->get();
        $pageTitle = __('messages.view_form_title', ['form' => __('messages.user')]);
        return view('jobseeker.view', compact('pageTitle', 'customerdata', 'auth_user', 'customer_pending_trans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $user = User::find($id);
        $msg = __('messages.msg_fail_to_delete', ['item' => __('messages.user')]);

        if ($user != '') {
            $user->delete();
            $msg = __('messages.msg_deleted', ['name' => __('messages.user')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return redirect()->back()->withSuccess($msg);
    }
    public function action(Request $request)
    {
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $id = $request->id;
        $user = User::withTrashed()->where('id', $id)->first();
        $msg = __('messages.not_found_entry', ['name' => __('messages.user')]);
        if ($request->type == 'restore') {
            $user->restore();
            $msg = __('messages.msg_restored', ['name' => __('messages.user')]);
        }
        if ($request->type === 'forcedelete') {
            $user->forceDelete();
            $msg = __('messages.msg_forcedelete', ['name' => __('messages.user')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return comman_custom_response(['message' => $msg, 'status' => true]);
    }
}
