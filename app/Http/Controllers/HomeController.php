<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Category;
use App\Models\ProviderDocument;
use App\Models\AppSetting;
use App\Models\Setting;
use App\Models\ProviderPayout;
use App\Models\HandymanPayout;
use App\Models\ServiceFaq;
use App\Models\AppDownload;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\JobsCategory;
use App\Models\Jobs;
use App\Models\JobsPayment;
use App\Models\JobsPlanCategory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? date('Y-m-d', strtotime($_GET["start"])) : ('');
            $end = (!empty($_GET["end"])) ? date('Y-m-d', strtotime($_GET["end"])) : ('');
            $data =  Booking::myBooking()->where('status', 'pending')->whereDate('date', '>=', $start)->whereDate('date',   '<=', $end)->with('service')->get();
            return response()->json($data);
        }

        $setting_data = Setting::select('value')->where('type', 'dashboard_setting')->where('key', 'dashboard_setting')->first();
        $data['dashboard_setting']  =   !empty($setting_data) ? json_decode($setting_data->value) : [];
        $provider_setting_data = Setting::select('value')->where('type', 'provider_dashboard_setting')->where('key', 'provider_dashboard_setting')->first();
        $data['provider_dashboard_setting']  =  !empty($provider_setting_data) ? json_decode($provider_setting_data->value) : [];
        $handyman_setting_data = Setting::select('value')->where('type', 'handyman_dashboard_setting')->where('key', 'handyman_dashboard_setting')->first();
        $data['handyman_dashboard_setting']  =   !empty($handyman_setting_data) ? json_decode($handyman_setting_data->value) : [];
        

        $data['dashboard'] = [
            'count_total_jobs'                  => Jobs::myJobs()->count(),
            // Get today's total jobs count
            'today_total_jobs' => Jobs::myJobs()->whereDate('updated_at', Carbon::today())->count(),
            'yesterday_total_jobs' => Jobs::myJobs()->whereDate('created_at', Carbon::yesterday())->count(),
            'count_total_booking'               => Booking::myBooking()->count(),
            'count_total_service'               => Service::myService()->count(),
            'count_total_provider'              => User::myUsers('get_provider')->count(),
            'new_customer'                      => User::myUsers('get_customer')->orderBy('id', 'DESC')->take(5)->get(),
            'new_provider'                      => User::myUsers('get_provider')->with('getServiceRating')->orderBy('id', 'DESC')->take(5)->get(),
            'upcomming_booking'                 => Booking::myBooking()->with('customer')->where('status', 'pending')->orderBy('id', 'DESC')->take(5)->get(),
            'top_services_list'                 => Booking::myBooking()->showServiceCount()->take(5)->get(),
            'count_handyman_pending_booking'    => Booking::myBooking()->where('status', 'pending')->count(),
            'count_handyman_complete_booking'   => Booking::myBooking()->where('status', 'completed')->count(),
            'count_handyman_cancelled_booking'  => Booking::myBooking()->where('status', 'cancelled')->count()
        ];

        $data['category_chart'] = [
            'chartdata'     => Booking::myBooking()->showServiceCount()->take(4)->get()->pluck('count_pid'),
            'chartlabel'    => Booking::myBooking()->showServiceCount()->take(4)->get()->pluck('service.category.name')
        ];

        $total_revenue      = Payment::where('payment_status', 'paid');
        $jobs_total_revenue      = JobsPayment::where('payment_status', 'paid');
        if (auth()->user()->hasAnyRole(['admin', 'demo_admin', 'executive'])) {
            $data['revenueData']    =  adminEarning();
        }
        if ($user->hasRole('provider')) {
            $revenuedata        = ProviderPayout::selectRaw('sum(amount) as total , DATE_FORMAT(created_at , "%m") as month')
                ->where('provider_id', auth()->user()->id)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month');
            $revenuedata = $revenuedata->get()->toArray();
            $data['revenueData']    =    [];
            for ($i = 1; $i <= 12; $i++) {
                $revenueData = 0;
                foreach ($revenuedata as $revenue) {
                    if ((int)$revenue['month'] == $i) {
                        $data['revenueData'][] = (int)$revenue['total'];
                        $revenueData++;
                    }
                }
                if ($revenueData == 0) {
                    $data['revenueData'][] = 0;
                }
            }
        }
        $data['jobs_total_revenue']  =    $jobs_total_revenue->sum('total_amount');
        $data['total_revenue']  =    $total_revenue->sum('total_amount');
        if ($user->hasRole('provider')) {
            $data['total_revenue']  = ProviderPayout::where('provider_id', $user->id)->sum('amount') ?? 0;
        }
        if ($user->hasRole('handyman')) {
            $data['total_revenue']  = HandymanPayout::where('handyman_id', $user->id)->sum('amount') ?? 0;
        }

        if (auth()->user()->hasRole(['admin', 'demo_admin', 'executive'])) {
            return $this->adminDashboard($data);
        } else if (auth()->user()->hasAnyRole('provider')) {
            return $this->providerDashboard($data);
        } else if (auth()->user()->hasAnyRole('handyman')) {
            return $this->handymanDashboard($data);
        } else {
            return $this->userDashboard($data);
        }
    }

    /**
     * Admin Dashboard
     *
     * @param $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminDashboard($data)
    {
        $show = "false";
        $dashboard_setting = Setting::where('type', 'dashboard_setting')->first();

        if ($dashboard_setting == null) {
            $show = "true";
        }
        return view('dashboard.dashboard', compact('data', 'show'));
    }
    public function providerDashboard($data)
    {
        $show = "false";
        $provider_dashboard_setting = Setting::where('type', 'provider_dashboard_setting')->first();

        if ($provider_dashboard_setting == null) {
            $show = "true";
        }
        return view('dashboard.provider-dashboard', compact('data', 'show'));
    }
    public function handymanDashboard($data)
    {
        $show = "false";
        $handyman_dashboard_setting = Setting::where('type', 'handyman_dashboard_setting')->first();

        if ($handyman_dashboard_setting == null) {
            $show = "true";
        }
        return view('dashboard.handyman-dashboard', compact('data', 'show'));
    }
    public function userDashboard($data)
    {
        return view('dashboard.user-dashboard', compact('data'));
    }
    public function changeStatus(Request $request)
    {
        if (demoUserPermission()) {
            $message = __('messages.demo_permission_denied');
            $response = [
                'status'    => false,
                'message'   => $message
            ];

            return comman_custom_response($response);
        }
        $type = $request->type;
        $message_form = __('messages.item');
        $message = trans('messages.update_form', ['form' => trans('messages.status')]);
        switch ($type) {
            case 'role':
                $role = \App\Models\Role::find($request->id);
                $role->status = $request->status;
                $role->save();
                break;
            case 'category_status':

                $category = \App\Models\Category::find($request->id);
                $category->status = $request->status;
                $category->save();
                break;
            case 'category_featured':
                $message_form = __('messages.category');
                $category = \App\Models\Category::find($request->id);
                $category->is_featured = $request->status;
                $category->save();
                break;
            case 'service_status':
                $service = \App\Models\Service::find($request->id);
                $service->status = $request->status;
                $service->save();
                break;
            case 'coupon_status':
                $coupon = \App\Models\Coupon::find($request->id);
                $coupon->status = $request->status;
                $coupon->save();
                break;
            case 'document_status':
                $document = \App\Models\Documents::find($request->id);
                $document->status = $request->status;
                $document->save();
                break;
            case 'document_required':
                $message_form = __('messages.document');
                $document = \App\Models\Documents::find($request->id);
                $document->is_required = $request->status;
                $document->save();
                break;
            case 'provider_is_verified':
                $message_form = __('messages.providerdocument');
                $document = \App\Models\ProviderDocument::find($request->id);
                $document->is_verified = $request->status;
                $document->save();
                break;
            case 'tax_status':
                $tax = \App\Models\Tax::find($request->id);
                $tax->status = $request->status;
                $tax->save();
                break;
            case 'provideraddress_status':
                $provideraddress = \App\Models\ProviderAddressMapping::find($request->id);
                $provideraddress->status = $request->status;
                $provideraddress->save();
                break;
            case 'slider_status':
                $slider = \App\Models\Slider::find($request->id);
                $slider->status = $request->status;
                $slider->save();
                break;
            case 'servicefaq_status':
                $servicefaq = \App\Models\ServiceFaq::find($request->id);
                $servicefaq->status = $request->status;
                $servicefaq->save();
                break;
            case 'wallet_status':
                $wallet = \App\Models\Wallet::find($request->id);
                $wallet->status = $request->status;
                $wallet->save();
                break;

            case 'subcategory_status':
                $subcategory = \App\Models\SubCategory::find($request->id);
                $subcategory->status = $request->status;
                $subcategory->save();
                break;
            case 'news_status':
                $newscategory = \App\Models\News::find(intval($request->id));
                $newscategory->status = $request->status;
                $newscategory->save();
                break;
            case 'news_featured':
                $message_form = __('messages.news');
                $subcategory = \App\Models\News::find($request->id);
                $subcategory->is_featured = $request->status;
                $subcategory->save();
                break;
            case 'newscategory_featured':
                $message_form = __('messages.news_category');
                $subcategory = \App\Models\NewsCategory::find($request->id);
                $subcategory->is_featured = $request->status;
                $subcategory->save();
                break;
            case 'newscategory_status':
                $jobs = \App\Models\NewsCategory::find(intval($request->id));
                $jobs->status = $request->status;
                $jobs->save();
                break;
            case 'jobs_status':
                $jobs = \App\Models\Jobs::find(intval($request->id));
                $jobs->status = $request->status;
                $jobs->save();
                break;
            case 'jobs_featured':
                $message_form = __('messages.jobs');
                $subcategory = \App\Models\Jobs::find($request->id);
                $subcategory->is_featured = $request->status;
                $subcategory->save();
                break;
            case 'jobscategory_featured':
                $message_form = __('messages.jobs_category');
                $subcategory = \App\Models\JobsCategory::find($request->id);
                $subcategory->is_featured = $request->status;
                $subcategory->save();
                break;
            case 'jobscategory_status':
                $jobs = \App\Models\JobsCategory::find(intval($request->id));
                $jobs->status = $request->status;
                $jobs->save();
                break;
            case 'subcategory_featured':
                $message_form = __('messages.subcategory');
                $subcategory = \App\Models\SubCategory::find($request->id);
                $subcategory->is_featured = $request->status;
                $subcategory->save();
                break;
            case 'plan_status':
                $plans = \App\Models\Plans::find($request->id);
                $plans->status = $request->status;
                $plans->save();
                break;
            case 'bank_status':
                $banks = \App\Models\Bank::find($request->id);
                $banks->status = $request->status;
                $banks->save();
                break;
            default:
                $message = 'error';
                break;
        }
        if ($request->has('is_featured') && $request->is_featured == 'is_featured') {
            $message =  __('messages.added_form', ['form' => $message_form]);
            if ($request->status == 0) {
                $message = __('messages.remove_form', ['form' => $message_form]);
            }
        }
        if ($request->has('is_required') && $request->is_required == 'is_required') {
            $message =  __('messages.added_form', ['form' => $message_form]);
            if ($request->status == 0) {
                $message = __('messages.remove_form', ['form' => $message_form]);
            }
        }
        if ($request->has('provider_is_verified') && $request->provider_is_verified == 'provider_is_verified') {
            $message =  __('messages.added_form', ['form' => $message_form]);
            if ($request->status == 0) {
                $message = __('messages.remove_form', ['form' => $message_form]);
            }
        }
        return comman_custom_response(['message' => $message, 'status' => true]);
    }

    public function getAjaxList(Request $request)
    {
        $items = array();
        $value = $request->q;
        $auth_user = authSession();
        switch ($request->type) {
            case 'permission':
                $items = \App\Models\Permission::select('id', 'name as text')->whereNull('parent_id');
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'category':
                $items = \App\Models\Category::select('id', 'name as text')->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', '%' . $value . '%');
                }
                $items = $items->get();
                break;
                // case 'news-category':
                //     $items = \App\Models\Category::select('id', 'name as text')->where('status', 1)->where('is_news', 1);

                //     if ($value != '') {
                //         $items->where('name', 'LIKE', '%' . $value . '%');
                //     }

                //     $items = $items->get();
                //     break;

            case 'news-category':
                $items = \App\Models\NewsCategory::select('id', 'name as text')->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', '%' . $value . '%');
                }

                $items = $items->get();
                break;

            case 'jobs-category':
                $items = \App\Models\JobsCategory::select('id', 'name as text')->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', '%' . $value . '%');
                }

                $items = $items->get();
                break;

            case 'jobs_plan_category':
                $items = \App\Models\JobsPlanCategory::select('id', 'ta_name as text')->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', '%' . $value . '%');
                }
                $items = $items->get();
                break;


            case 'provider':
                $items = \App\Models\User::select('id', 'display_name as text')
                    ->where('user_type', 'provider')
                    ->where('status', 1);

                if ($value != '') {
                    $items->where('display_name', 'LIKE', $value . '%');
                }

                $items = $items->get();
                break;

            case 'user':
                $items = \App\Models\User::select('id', 'contact_number as text', 'first_name')
                    ->where('user_type', 'user')
                    ->where('status', 1);

                if ($value != '') {
                    $items->where('contact_number', 'LIKE', $value . '%');
                }

                $items = $items->get();
                break;

            case 'news_user':
                $items = \App\Models\User::select('id', DB::raw("CONCAT(contact_number, ' - [', first_name, ']') as text"))
                    ->where('user_type', 'user')
                    ->where('status', 1);
                if ($value != '') {
                    $items->where('contact_number', 'LIKE', $value . '%');
                }

                $items = $items->get();
                break;
            case 'jobs':
                $items = \App\Models\User::select('id', 'contact_number as text')
                    ->where('user_type', 'jobs')
                    ->where('status', 1);
                if ($value != '') {
                    $items->where('contact_number', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'get-user':
                $items = \App\Models\User::select('id', 'contact_number as text');
                if (isset($request->user_id)) {
                    $items->where('id', $request->user_id);
                }
                if ($value != '') {
                    $items->where('contact_number', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;

            case 'setuser':

                $items = \App\Models\User::select('id', 'contact_number as text', 'display_name');

                if (isset($request->user_type)) {
                    $items->where('user_type', $request->user_type);
                }
                $items->where('contact_number', $request->mobile_no);

                $items = $items->get();
                break;

            case 'handyman':
                $items = \App\Models\User::select('id', 'display_name as text')
                    ->where('user_type', 'handyman')
                    ->where('status', 1);

                if (isset($request->provider_id)) {
                    $items->where('provider_id', $request->provider_id);
                }

                if (isset($request->booking_id)) {
                    $booking_data = Booking::find($request->booking_id);

                    $service_address = $booking_data->handymanByAddress;

                    if ($service_address != null) {
                        $items->where('service_address_id', $service_address->id);
                    }
                }

                if ($value != '') {
                    $items->where('display_name', 'LIKE', $value . '%');
                }

                $items = $items->get();
                break;
            case 'service':
                $items = \App\Models\Service::select('id', 'name as text', 'price', 'discount')->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', '%' . $value . '%');
                }
                if (isset($request->provider_id)) {
                    $items->where('provider_id', $request->provider_id);
                }

                $items = $items->get();
                break;
            case 'servicedetails':
                $items = \App\Models\Service::select('id', 'price', 'discount')->where('status', 1);


                if (isset($request->service_id)) {
                    $items->where('id', $request->service_id);
                }

                $items = $items->get();
                break;
            case 'providertype':
                $items = \App\Models\ProviderType::select('id', 'name as text')
                    ->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }

                $items = $items->get();
                break;
            case 'coupon':
                $items = \App\Models\Coupon::select('id', 'code as text')->where('status', 1);

                if ($value != '') {
                    $items->where('code', 'LIKE', '%' . $value . '%');
                }

                $items = $items->get();
                break;
            case 'country':
                $items = \App\Models\Country::select('id', 'name as text');

                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'state':
                $items = \App\Models\State::select('id', 'name as text');
                if (isset($request->country_id)) {
                    $items->where('country_id', $request->country_id);
                }
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }
                $items = $items->orderBy('name', 'asc')->get();
                break;
            case 'district':
                $items = \App\Models\District::select('id', 'name as text');
                if (isset($request->state_id)) {
                    $items->where('state_id', $request->state_id);
                }
                // if (isset($request->district_id)) {
                //     $items->where('district_id', $request->district_id);
                // }
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }
                $items = $items->orderBy('name', 'asc')->get();
                break;
            case 'city':
                $items = \App\Models\City::select('id', 'name as text');
                if (isset($request->district_id)) {
                    $items->where('district_id', $request->district_id);
                }
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'booking_status':
                $items = \App\Models\BookingStatus::select('id', 'label as text');

                if ($value != '') {
                    $items->where('label', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;

            case 'existing_customer':

                $mobile_no = !empty($request->mobile_no) ? $request->mobile_no : '';
                $items = \App\Models\User::select('id')->where('contact_number', $mobile_no)->where('user_type', $request->user_type ? $request->user_type : 'user')->get();



                if (!$items->isEmpty()) {

                    $items = array("status_code" => 200, "msg" => 'user found');
                } else {

                    $items = array("status_code" => 404, "msg" => 'user not found');
                }
                break;

            case 'currency':
                $items = \DB::table('countries')->select(\DB::raw('id id,CONCAT(name , " ( " , symbol ," ) ") text'));

                $items->whereNotNull('symbol')->where('symbol', '!=', '');
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%')->orWhere('currency_code', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'country_code':
                $items = \DB::table('countries')->select(\DB::raw('code id,name text'));
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%')->orWhere('code', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;

            case 'time_zone':
                $items = timeZoneList();

                foreach ($items as $k => $v) {

                    if ($value != '') {
                        if (strpos($v, $value) !== false) {
                        } else {
                            unset($items[$k]);
                        }
                    }
                }

                $data = [];
                $i = 0;
                foreach ($items as $key => $row) {
                    $data[$i] = [
                        'id'    => $key,
                        'text'  => $row,
                    ];
                    $i++;
                }
                $items = $data;
                break;
            case 'provider_address':
                $provider_id = !empty($request->provider_id) ? $request->provider_id : $auth_user->id;
                $items = \App\Models\ProviderAddressMapping::select('id', 'address as text', 'latitude', 'longitude', 'status')->where('provider_id', $provider_id)->where('status', 1);
                $items = $items->get();
                break;

            case 'provider_tax':
                $provider_id = !empty($request->provider_id) ? $request->provider_id : $auth_user->id;
                $items = \App\Models\Tax::select('id', 'title as text')->where('status', 1);
                $items = $items->get();
                break;

            case 'documents':
                $items = \App\Models\Documents::select('id', 'name', 'status', 'is_required', \DB::raw('(CASE WHEN is_required = 1 THEN CONCAT(name," * ") ELSE CONCAT(name,"") END) AS text'))->where('status', 1);
                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'handymantype':
                $items = \App\Models\HandymanType::select('id', 'name as text')
                    ->where('status', 1);

                if ($value != '') {
                    $items->where('name', 'LIKE', $value . '%');
                }

                $items = $items->get();
                break;
            case 'subcategory_list':
                $category_id = !empty($request->category_id) ? $request->category_id : '';
                $items = \App\Models\SubCategory::select('id', 'name as text')->where('category_id', $category_id)->where('status', 1);
                $items = $items->get();
                break;

            case 'push_pvt_jobs':
                // $district_id = !empty($request->district_id) ? $request->district_id : '';
                // $items = \App\Models\Jobs::select('id', 'address as text', 'latitude', 'longitude', 'status')->where('provider_id', $district_id)->where('status', 1);
                // $items = $items->get();
                $items = \App\Models\Jobs::select('id', 'title as text')->withTrashed();
                $items->where('end_date', '>=', DB::raw('CURRENT_DATE()'))->orderByDesc('id');
                if (isset($request->district_id)) {
                    if ($request->district_id == '100') {
                        $items->where('status', 1);
                    } else if ($request->district_id == "null") {
                        $items->where('status', 1);
                    } else {
                        $items->where('status', 1);
                        $items->whereHas('jobDistricts', function ($a) use ($request) {
                            $a->where('district_id', $request->district_id);
                            $a->orWhere('district_id',  100);
                        });
                    }
                } else {
                    $items->where('status', 1);
                }
                $items = $items->get();
                break;
            case 'push_news':

                $items = \App\Models\News::select('id', 'title as text')->withTrashed();
                $daysAgo = 5;
                $dateThreshold = Carbon::now()->subDays($daysAgo);


                $items->where('status', 1);

                $items->where('updated_at', '>=', $dateThreshold);
                $items = $items->get();
                break;

            case 'push_govt_jobs':

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.jobs7.in/api-service/push-noty-jobs.php?districtlink=jobs-in-all-districts&stateid=2");

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',

                ));

                $items = curl_exec($ch);

                $items = json_decode($items);

                if ($items === false) {
                    echo 'cURL Error: ' . curl_error($ch);
                    curl_close($ch);
                    die();
                }

                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($http_code != 200) {
                    echo 'Error: HTTP Status Code: ' . $http_code;
                    curl_close($ch);
                    die();
                }

                curl_close($ch);

                break;

            case 'get-jobs':
                $items = \App\Models\Jobs::select('id', 'title as text')
                    ->orderBy('id', 'desc');

                if (isset($request->job_id)) {
                    $items->where('id', $request->job_id);
                }
                if ($value != '') {
                    $items->where('title', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;

            case 'get-employer':
                $items = \App\Models\Jobs::select('user_id')
                    ->orderBy('id', 'desc')
                    ->where('status', 1)
                    ->where('id', $request->job_id);

                if ($value != '') {
                    $items->where('title', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            case 'get-plans':
                $items = \App\Models\Jobs::select('id', 'title as text')
                    ->orderBy('id', 'desc')
                    ->where('status', 1);
                if ($value != '') {
                    $items->where('title', 'LIKE', $value . '%');
                }
                $items = $items->get();
                break;
            default:
                break;
        }
        return response()->json(['status' => 'true', 'results' => $items]);
    }

    public function removeFile(Request $request)
    {
        if (demoUserPermission()) {
            $message = __('messages.demo_permission_denied');
            $response = [
                'status'    => false,
                'message'   => $message
            ];

            return comman_custom_response($response);
        }

        $type = $request->type;
        $data = null;
        switch ($type) {
            case 'slider_image':
                $data = Slider::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.slider')]);
                break;
            case 'profile_image':
                $data = User::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.profile_image')]);
                break;
            case 'service_attachment':
                $media = Media::find($request->id);
                $media->delete();
                $message = __('messages.msg_removed', ['name' => __('messages.attachments')]);
                break;
            case 'category_image':
                $data = Category::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.category')]);
                break;
            case 'provider_document':
                $data = ProviderDocument::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.providerdocument')]);
                break;
            case 'booking_attachment':
                $media = Media::find($request->id);
                $media->delete();
                $message = __('messages.msg_removed', ['name' => __('messages.attachments')]);
                break;
            case 'bank_attachment':
                $media = Media::find($request->id);
                $media->delete();
                $message = __('messages.msg_removed', ['name' => __('messages.attachments')]);
                break;
            case 'app_image':
                $data = AppDownload::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.attachments')]);
                break;
            case 'app_image_full':
                $data = AppDownload::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.attachments')]);
                break;
            case 'after_service_image':
                $data = Booking::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;
            case 'before_service_image':
                $data = Booking::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;
            case 'news_image':
                $data = News::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;

            case 'news_video':
                $data = News::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.video')]);
                break;

            case 'jobs_category_image':
                $data = JobsCategory::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;

            case 'news_category_image':
                $data = NewsCategory::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;

            case 'jobs_image':
                $data = Jobs::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;
            case 'jobs_featured':
                $data = Jobs::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;
            case 'jobs_plans_category_image':
                $data = JobsPlanCategory::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;


            default:
                $data = AppSetting::find($request->id);
                $message = __('messages.msg_removed', ['name' => __('messages.image')]);
                break;
        }

        if ($data != null) {
            $data->clearMediaCollection($type);
        }

        $response = [
            'status'    => true,
            'image'     => getSingleMedia($data, $type),
            'id'        => $request->id,
            'preview'   => $type . "_preview",
            'message'   => $message
        ];

        return comman_custom_response($response);
    }

    public function lang($locale)
    {
        \App::setLocale($locale);
        session()->put('locale', $locale);
        \Artisan::call('cache:clear');
        $dir = 'ltr';
        if (in_array($locale, ['ar', 'dv', 'ff', 'ur', 'he', 'ku', 'fa'])) {
            $dir = 'rtl';
        }

        session()->put('dir',  $dir);
        return redirect()->back();
    }


    function authRegister()
    {
        return view('auth.register');
    }

    function authRecoverPassword()
    {
        return view('auth.forgot-password');
    }

    function authConfirmEmail()
    {
        return view('auth.verify-email');
    }
}
