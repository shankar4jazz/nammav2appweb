<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\DataTables\NewsDataTable;
use App\Http\Requests\NewsRequest;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsDataTable $dataTable)
    {
        /**
         * permission denied for user, provider, handyman. only can access admin, executive
         * Permission Access asigned user
         *     
         */
        $auth_user = authSession();
        if (!$auth_user->can('news list') ) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        $pageTitle = trans('messages.list_form_title', ['form' => trans('messages.news')]);
        $auth_user = authSession();
        $assets = ['datatable'];
        return $dataTable->render('news.index', compact('pageTitle', 'auth_user', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $auth_user = authSession();
        if (!$auth_user->can('news add')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        $id = $request->id;
        $subcategory = News::find($id);
        // $subcategory->country_id = '101';
        // $subcategory->state_id = '35';
        $pageTitle = trans('messages.update_form_title', ['form' => trans('messages.news')]);

        if ($subcategory == null) {
            $pageTitle = trans('messages.add_button_form', ['form' => trans('messages.news')]);
            $subcategory = new News;
            $subcategory->country_id = '101';
            $subcategory->state_id = '35';
        }

        return view('news.create', compact('pageTitle', 'subcategory', 'auth_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {

        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }

        $auth_user = authSession();
        if (!$auth_user->can('news add')) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }

        $data = $request->all();
        $loginuser = \Auth::user();
        $data['is_featured'] = 0;
        if ($request->has('is_featured')) {
            $data['is_featured'] = 1;
        }
        $data['user_id'] = $loginuser['id'];
        

        $result = News::updateOrCreate(['id' => $data['id']], $data);

        storeMediaFile($result, $request->news_image, 'news_image');

        if ($request->news_video) {
            storeMediaFile($result, $request->news_video, 'news_video');
        }

        $message = trans('messages.update_form', ['form' => trans('messages.news')]);
        if ($result->wasRecentlyCreated) {
            $message = trans('messages.save_form', ['form' => trans('messages.news')]);
        }
        if ($request->is('api/*')) {
            return comman_message_response($message);
        }
        return redirect(route('news.index'))->withSuccess($message);
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
        if (!$auth_user->can('news delete') ) {
            return  redirect()->back()->withErrors(trans('messages.permission_denied'));
        }
        if (demoUserPermission()) {
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }

        $subcategory = News::find($id);
        $msg = __('messages.msg_fail_to_delete', ['name' => __('messages.news')]);

        if ($subcategory != '') {
            $subcategory->delete();
            $msg = __('messages.msg_deleted', ['name' => __('messages.news')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return redirect()->back()->withSuccess($msg);
    }
    public function action(Request $request)
    {

       
        $id = $request->id;

        $subcategory  = News::withTrashed()->where('id', $id)->first();
        $msg = __('messages.not_found_entry', ['name' => __('messages.news')]);
        if ($request->type == 'restore') {
            $subcategory->restore();
            $msg = __('messages.msg_restored', ['name' => __('messages.news')]);
        }
        if ($request->type === 'forcedelete') {
            $subcategory->forceDelete();
            $msg = __('messages.msg_forcedelete', ['name' => __('messages.news')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return comman_custom_response(['message' => $msg, 'status' => true]);
    }
}
