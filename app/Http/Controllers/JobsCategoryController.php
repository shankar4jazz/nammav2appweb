<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobsCategory;
use App\Models\Service;
use App\DataTables\JobsCategoryDataTable;
use App\Http\Requests\JobsCategoryRequest;

class JobsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobsCategoryDataTable $dataTable)
    {
        $auth_user = authSession();
        if (!$auth_user->can('jobs categories list')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        $pageTitle = trans('messages.list_form_title',['form' => trans('messages.jobs_category')] );
       
        $assets = ['datatable'];
        return $dataTable->render('jobscategory.index', compact('pageTitle','auth_user','assets'));
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
        if (!$auth_user->can('jobs categories add')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }

        $categorydata = JobsCategory::find($id);
        $pageTitle = trans('messages.update_form_title',['form'=>trans('messages.jobs_category')]);
        
        if($categorydata == null){
            $pageTitle = trans('messages.add_button_form',['form' => trans('messages.jobs_category')]);
            $categorydata = new JobsCategory;
        }
        
        return view('jobscategory.create', compact('pageTitle' ,'categorydata' ,'auth_user' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobsCategoryRequest $request)
    {   
        $auth_user = authSession();
        if (!$auth_user->can('jobs categories add')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $data = $request->all();
               
        $data['is_featured'] = 0;
        if($request->has('is_featured')){
			$data['is_featured'] = 1;
		}
        $data['slug'] = $this->convertSlug($data['name']);
       
        $result = JobsCategory::updateOrCreate(['id' => $data['id'] ],$data);

        storeMediaFile($result,$request->jobs_category_image, 'jobs_category_image');

        $message = trans('messages.update_form',['form' => trans('messages.category')]);
        if($result->wasRecentlyCreated){
            $message = trans('messages.save_form',['form' => trans('messages.category')]);
        }
        if($request->is('api/*')) {
            return comman_message_response($message);
		}
        return redirect(route('jobs-categories.index'))->withSuccess($message);        
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
        if (!$auth_user->can('jobs categories delete')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $category = JobsCategory::find($id);
        $msg= __('messages.msg_fail_to_delete',['name' => __('messages.jobs_category')] );
        
        if($category!='') { 

            ///$service = Service::where('category_id',$id)->first();
        
            $category->delete();
            $msg= __('messages.msg_deleted',['name' => __('messages.jobs_category')] );
        }
        if(request()->is('api/*')) {
            return comman_message_response($msg);
		}
        return redirect()->back()->withSuccess($msg);
    }   
    public function action(Request $request){
        $id = $request->id;      

        $category  = JobsCategory::withTrashed()->where('id',$id)->first();
        $msg = __('messages.not_found_entry',['name' => __('messages.jobs_category')] );
        if($request->type == 'restore') {
            $category->restore();
            $msg = __('messages.msg_restored',['name' => __('messages.jobs_category')] );
        }
        if($request->type === 'forcedelete'){
            $category->forceDelete();
            $msg = __('messages.msg_forcedelete',['name' => __('messages.jobs_category')] );
        }
   
        if(request()->is('api/*')){
            return comman_message_response($msg);
		}
        return comman_custom_response(['message'=> $msg , 'status' => true]);
    }
    private function convertSlug($text)
    {

        $text = strtolower($text);
        $text = preg_replace('/\s+/', '-', $text);
        $text = preg_replace('/[^\w-]+/', '', $text);
        return $text;
    }
    
}
