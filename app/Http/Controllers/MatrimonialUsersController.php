<?php

namespace App\Http\Controllers;
use App\Models\MatrimonialUsers;
use App\Models\Service;
use App\DataTables\JobsDataTable;
use App\Http\Requests\JobsRequest;
use Illuminate\Http\Request;

class MatrimonialUsersController extends Controller
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
    } //

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $auth_user = authSession();
        if (!$auth_user->can('jobs add')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $id = $request->id;

        $jobsdata = MatrimonialUsers::find($id);

        $pageTitle = trans('messages.update_form_title', ['form' => trans('messages.register')]);

        if ($jobsdata == null) {
            $pageTitle = trans('messages.add_button_form', ['form' => trans('messages.register')]);
            $jobsdata = new MatrimonialUsers();
            $jobsdata->country_id = '101';
            $jobsdata->state_id = '35';
        }

        return view('matrimonial.users.create', compact('pageTitle', 'jobsdata', 'auth_user'));
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
        if (!$auth_user->can('jobs add')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        $data = $request->all();
        $data['is_featured'] = 0;
        if ($request->has('is_featured')) {
            $data['is_featured'] = 1;
        }

       
      
        $result = MatrimonialUsers::updateOrCreate(['id' => $data['id']], $data);

        storeMediaFile($result, $request->jobs_image, 'jobs_image');

        $message = trans('messages.update_form', ['form' => trans('messages.jobs')]);
        if ($result->wasRecentlyCreated) {
            $message = trans('messages.save_form', ['form' => trans('messages.jobs')]);
        }
        if ($request->is('api/*')) {
            return comman_message_response($message);
        }
        return redirect(route('matrimonial.index'))->withSuccess($message);
    }
}
