<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobsPlans;
use App\Models\PlanLimit;
use App\Models\StaticData;
use App\Models\JobsPlanCategory;
use App\DataTables\JobPlanDataTable;
use App\Http\Requests\PlanRequest;

class JobPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobPlanDataTable $dataTable)
    {
        $pageTitle = trans('messages.list_form_title',['form' => trans('Job Plan')] );
        $auth_user = authSession();
        $assets = ['datatable'];
        return $dataTable->render('jobsplan.index', compact('pageTitle','auth_user','assets'));
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

        $plan = JobsPlans::with('planlimit')->find($id);
        $plan_type = StaticData::where('type','plan_type')->get();
     
        $plan_limit = StaticData::where('type','plan_limit_type')->get();
        $pageTitle = trans('messages.update_form_title',['form'=>trans('messages.plan')]);
        $decoded_description = '';
        if($plan == null){
            $pageTitle = trans('messages.add_button_form',['form' => trans('messages.plan')]);
            $plan = new JobsPlans;
        }
        else{
            $decoded_description = base64_decode($plan->description);
       
            $is_base64_encoded = base64_encode(base64_decode($plan->description)) === $plan->description;
            if ($is_base64_encoded) {
    
                $decoded_description ;
                
            } else {           
                // The string is base64 encoded and has been decoded
                 $decoded_description = $plan->description; // Outputs "Hello World!"
            }
        }
        return view('jobsplan.create', compact('pageTitle' ,'plan' ,'auth_user','plan_type','plan_limit', 'decoded_description' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $requestData = $request->all();
        $plans = JobsPlans::where('title', '=', $requestData['title'])->first();
        if ($plans !== null && $request->id == null) {
            return  redirect()->back()->withErrors(__('validation.unique',['attribute'=>__('messages.plan')]));
        }
        $data = base64_encode($requestData['description']);

     
        $planData = [
            'title' => $requestData['title'],
            'amount' => $requestData['amount'],
            'tax' => $requestData['tax'],
            'total_amount' => $requestData['total_amount'],
            'status' => $requestData['status'],
            'duration' => $requestData['duration'],
            'trial_period' => $requestData['trial_period'],
            'price' => $requestData['price'],
            'percentage' => $requestData['percentage'],
            'description' =>  $data,
            'plan_type' => $requestData['plan_type'],
            'type'=> $requestData['type'],
            'plancategory_id'=> $requestData['plancategory_id']
        ];

      
        if(empty($request->id) && $request->id == null){
            $planData['identifier'] = strtolower($requestData['title']);
        }
        $result = JobsPlans::updateOrCreate(['id' => $requestData['id'] ],$planData);
    
        
        $message = trans('messages.update_form',['form' => trans('messages.plan')]);

        if($result->wasRecentlyCreated){
            $message = trans('messages.save_form',['form' => trans('messages.plan')]);
        }

        return redirect(route('jobs-plans.index'))->withSuccess($message);        
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
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $plan = JobsPlans::find($id);
        $msg= __('messages.msg_fail_to_delete',['item' => __('messages.plan')] );
        
        if($plan!='') {
            if($plan->planlimit()->count() > 0)
            {
                $plan->planlimit()->delete();
            }
            $plan->delete();
            $msg= __('messages.msg_deleted',['name' => __('messages.plan')] );
        }
        return redirect()->back()->withSuccess($msg);
    }
}
