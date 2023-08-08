<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobsPayment;
use App\Models\Jobs;
use App\Models\JobsPlans;
use App\Models\JobsPlanCategory;

use App\DataTables\JobsPaymentDataTable;

class JobsPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobsPaymentDataTable $dataTable)
    {
        $pageTitle = __('messages.list_form_title', ['form' => __('messages.payment')]);
        $assets = ['datatable'];
        return $dataTable->render('jobspayment.index', compact('pageTitle', 'assets'));
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

        $plan = JobsPayment::find($id);        

        $plan_category = JobsPlanCategory::where('status', 1)->get();       
     
        $pageTitle = trans('messages.update_form_title', ['form' => trans('messages.plan')]);

        $decoded_description = '';
        $plans = null;
        if ($plan == null) {
            $pageTitle = trans('messages.add_button_form', ['form' => trans('messages.plan')]);
            $plan = new JobsPayment();
        } 
        else {
            $plans = JobsPlans::where('id', $plan->plan_id)->first();
            $decoded_description = base64_decode($plan->description);
            $is_base64_encoded = base64_encode(base64_decode($plan->description)) === $plan->description;

            if ($is_base64_encoded) {
                
                $decoded_description;
            } else {

                $decoded_description = $plan->description; // Outputs "Hello World!"
            }
        }
      
        return view('jobspayment.create', compact('pageTitle', 'plan', 'plans', 'plan_category', 'auth_user', 'decoded_description'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $requestData = $request->all();

        $date_data = isset($request->datetime) ? date('Y-m-d H:i:s', strtotime($request->datetime)) : date('Y-m-d H:i:s');
        $data = base64_encode($requestData['description']);


        $planData = [
            'job_id' => $requestData['job_id'],
            'employer_id' => $requestData['employer_id'],
            'plan_id' => $requestData['plan_id'],
            'total_amount' => $requestData['all_total_amount'],
            'payment_type' => $requestData['payment_type'],
            'payment_status' => $requestData['payment_status'],
            'description' => $data,
            'datetime' => $date_data
        ];



        $result = JobsPayment::updateOrCreate(['id' => $requestData['id']], $planData);
        $startDate = date('Y-m-d'); // use the current date as the start date


        $endDate = date('Y-m-d', strtotime('+' . $requestData['trial_period'] . 'days', strtotime($startDate))); // add 30 days to the start date to get the end date
        //$endDate = date('Y-m-d', strtotime($startDate . ' + ' . $requestData['trial_period'] . ' days')); // add 30 days to the start date to get the end date

        $booking = Jobs::find($requestData['job_id']);
        $booking->payment_id = $result->id;
        $booking->end_date = $endDate;
        $booking->plan_id = $requestData['plan_id'];
        $booking->save();

        if ($result->payment_status == 'paid') {
            sendWhatsAppText($booking->id, 'paid');
        }
        if ($result->payment_status == 'failed') {
            sendWhatsAppText($booking->id, 'failed');
        }
        $message = trans('messages.update_form', ['form' => trans('messages.plan')]);

        if ($result->wasRecentlyCreated) {
            $message = trans('messages.save_form', ['form' => trans('messages.plan')]);
        }

        return redirect(route('jobs-payment.index'))->withSuccess($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $auth_user = authSession();
        if (!$auth_user->can('jobs delete')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $category = Jobspayment::find($id);
        $msg = __('messages.msg_fail_to_delete', ['name' => __('jobs payment')]);

        if ($category != '') {

            ///$service = Service::where('category_id',$id)->first();

            $category->delete();
            $msg = __('messages.msg_deleted', ['name' => __('jobs payment')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return redirect()->back()->withSuccess($msg);
    }


    public function action(Request $request)
    {


        $id = $request->id;

        $category  = JobsPayment::withTrashed()->where('id', $id)->first();
        $msg = __('messages.not_found_entry', ['name' => __('jobs payment')]);
        if ($request->type == 'restore') {
            $category->restore();
            $msg = __('messages.msg_restored', ['name' => __('jobs payment')]);
        }
        if ($request->type === 'forcedelete') {
            $category->forceDelete();
            $msg = __('messages.msg_forcedelete', ['name' => __('jobs payment')]);
        }

        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return comman_custom_response(['message' => $msg, 'status' => true]);
    }
}
