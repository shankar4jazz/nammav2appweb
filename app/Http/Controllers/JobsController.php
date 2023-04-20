<?php

namespace App\Http\Controllers;





use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Service;
use App\DataTables\JobsDataTable;
use App\Http\Requests\JobsRequest;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobsDataTable $dataTable)
    {
        $auth_user = authSession();
        if (!$auth_user->can('jobs list')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        $pageTitle = trans('messages.list_form_title', ['form' => trans('messages.jobs')]);
        $auth_user = authSession();
        $assets = ['datatable'];
        return $dataTable->render('jobs.index', compact('pageTitle', 'auth_user', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        if ($request->is('api/*')) {

            dd("hlo");
            // return comman_message_response($message);
        }
        $auth_user = authSession();
        if (!$auth_user->can('jobs add')) {
            // return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        if (demoUserPermission()) {
            //  return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $id = $request->id;

        $jobsdata = Jobs::find($id);

        $pageTitle = trans('messages.update_form_title', ['form' => trans('messages.jobs')]);
        $decoded_description = '';
        if ($jobsdata == null) {
            $pageTitle = trans('messages.add_button_form', ['form' => trans('messages.jobs')]);
            $jobsdata = new Jobs;
            $jobsdata->country_id = '101';
            $jobsdata->state_id = '35';
        } else {
            $decoded_description = base64_decode($jobsdata->description);

            $is_base64_encoded = base64_encode(base64_decode($jobsdata->description)) === $jobsdata->description;
            if ($is_base64_encoded) {

                $decoded_description;
            } else {
                // The string is base64 encoded and has been decoded
                $decoded_description = $jobsdata->description; // Outputs "Hello World!"
            }
        }

        return view('jobs.create', compact('pageTitle', 'jobsdata', 'auth_user', 'decoded_description'));
    }

    public function quickJob(Request $request)
    {
        //$id = $request->id;        
        $auth_user = authSession();
        // $bookingdata = Booking::find($id);
        $pageTitle = __('messages.jobs', ['form' => __('messages.jobs')]);

        // if ($bookingdata == null) {
        //     $pageTitle = __('messages.add_button_form', ['form' => __('messages.booking')]);
        //     $bookingdata = new Booking;
        // }

        return view('jobs.fast', compact('pageTitle',  'auth_user'));
    }

    public function quickJobAdd(Request $request)
    {
        //$id = $request->id;        
        $auth_user = authSession();


        $id = $request->mobile_no;

        $auth_user = authSession();

        $jobsdata = Jobs::find($id);

        $pageTitle = __('messages.quick_form_title', ['form' => __('messages.jobs')]);
        $decoded_description = '';
        if ($jobsdata == null) {
            $pageTitle = __('messages.add_button_form', ['form' => __('messages.jobs')]);
            $jobsdata = new Jobs;
        } else {
            $decoded_description = base64_decode($jobsdata->description);

            $is_base64_encoded = base64_encode(base64_decode($jobsdata->description)) === $jobsdata->description;
            if ($is_base64_encoded) {

                $decoded_description;
            } else {
                // The string is base64 encoded and has been decoded
                $decoded_description = $jobsdata->description; // Outputs "Hello World!"
            }
        }
      
        $jobsdata['contact_number_data'] = $id;



        return view('jobs.fastcreate', compact('pageTitle', 'jobsdata', 'auth_user', 'decoded_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (demoUserPermission()) {
        //     return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        // }
        $auth_user = authSession();
        //if (!$auth_user->can('jobs add')) {
        //    return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        // }
        $data = $request->all();
        $data['is_featured'] = 0;
        if ($request->has('is_featured')) {
            $data['is_featured'] = 1;
        }
        $data['disclose_company'] = 0;
        if ($request->has('disclose_company')) {
            $data['disclose_company'] = 1;
        }
        $data['disclose_salary'] = 0;
        if ($request->has('disclose_salary')) {
            $data['disclose_salary'] = 1;
        }

        if (isset($request->user_id)) {
            $data['user_id'] = $request->user_id;
        } else {
            $data['user_id'] =  $auth_user->id;
        }
        
        $data['description'] = base64_encode($request->description);

        if(isset($data['city_name'])){
        
        $slug_text = $data['job_role'] . ' in ' . $data['company_name']. ' ' . $data['city_name'] .' '. time();
        $data['slug'] = $this->convertSlug($slug_text);
        }

        $result = Jobs::updateOrCreate(['id' => $data['id']], $data);

        $result->jobDistricts()->detach();



        if ($request->input('districts') !== null) {
            foreach ($request->input('districts') as $row) {

                $result->jobDistricts()->sync($row, []);
            }
        }

        storeMediaFile($result, $request->jobs_image, 'jobs_image');

        $message = trans('messages.update_form', ['form' => trans('messages.jobs')]);
        if ($result->wasRecentlyCreated) {
            $message = trans('messages.save_form', ['form' => trans('messages.jobs')]);
        }

        if ($request->is('api/*')) {
            return comman_message_response($message);
        }

        return redirect(route('jobs.index'))->withSuccess($message);
    }

    public function saveJobPost(Request $request)
    {
        // if (demoUserPermission()) {
        //     return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        // }
        $auth_user = authSession();
        //if (!$auth_user->can('jobs add')) {
        //    return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        // }
        $data = $request->all();
        $data['is_featured'] = 0;
        if ($request->has('is_featured')) {
            $data['is_featured'] = 1;
        }

        if (isset($request->user_id)) {
            $data['user_id'] = $request->user_id;
        }

        $result = Jobs::updateOrCreate(['id' => $data['id']], $data);


        $jobs = Jobs::find($result->id);

        $result->jobDistricts()->detach();
        $distData =  $request->input('districts');



        if ($request->input('districts') !== null) {
            $distData = json_encode($request->input('districts'));

            $decodedJson = json_decode($distData);

            $dcode = json_decode($decodedJson, true);

            foreach ($dcode as $row) {


                $result->jobDistricts()->sync($row['id'], []);
            }
        }


        storeMediaFile($result, $request->jobs_image, 'jobs_image');

        $message = trans('messages.update_form', ['form' => trans('messages.jobs')]);
        if ($result->wasRecentlyCreated) {
            $message = trans('messages.save_form', ['form' => trans('messages.jobs')]);
        }






        if ($request->is('api/*')) {
            return  comman_custom_response($jobs, 200);
        }
        return redirect(route('jobs.index'))->withSuccess($jobs);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function show(Jobs $jobs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobs $jobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobs  $jobs
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
        $category = Jobs::find($id);
        $msg = __('messages.msg_fail_to_delete', ['name' => __('messages.jobs_category')]);

        if ($category != '') {

            ///$service = Service::where('category_id',$id)->first();

            $category->delete();
            $msg = __('messages.msg_deleted', ['name' => __('messages.jobs_category')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return redirect()->back()->withSuccess($msg);
    }
    public function action(Request $request)
    {


        $id = $request->id;

        $category  = Jobs::withTrashed()->where('id', $id)->first();
        $msg = __('messages.not_found_entry', ['name' => __('messages.jobs_category')]);
        if ($request->type == 'restore') {
            $category->restore();
            $msg = __('messages.msg_restored', ['name' => __('messages.jobs_category')]);
        }
        if ($request->type === 'forcedelete') {
            $category->forceDelete();
            $msg = __('messages.msg_forcedelete', ['name' => __('messages.jobs_category')]);
        }

        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return comman_custom_response(['message' => $msg, 'status' => true]);
    }

    private function convertSlug($text)
    {

        $text = strtolower($text);
        $text = preg_replace('/\s+/', '-', $text);
        $text = preg_replace('/[^\w-]+/', '', $text);
        return $text;
    }
}
