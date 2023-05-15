<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\JobsCategory;
use App\Models\JobsViews;
use App\Models\JobCallActivities;
use App\Http\Resources\API\JobsViewResource;
use App\Http\Resources\API\JobsResource;
use App\Models\District;
use Carbon\Carbon;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function getJobsList(Request $request)
    {
        $booking = Jobs::where('status', 1)->where('end_date', '>=', DB::raw('CURRENT_DATE()'));

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }

        $per_page = 10;
        $page = $request->page;

        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
        }
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $items = JobsResource::collection($booking);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];

        return comman_custom_response($items);
    }

    public function getJobsListBySlug(Request $request)
    {

        $id = $request->slug;
        $booking = Jobs::with('getJobDistricts.district')->where('id', $id)->where('status', 1)->get();


        if (!empty($booking)) {
            $view = JobsViews::firstOrCreate(['jobs_id' => $id]);
            $view->count++;
            $view->save();
        }
        $items = JobsViewResource::collection($booking);
        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];
        return comman_custom_response($items);
    }

    public function getJobById(Request $request)
    {

        $id = $request->id;

        $booking = Jobs::with('getJobDistricts.district')->where('id', $id)->where('status', 1)->get();


        if (!empty($booking)) {
            $view = JobsViews::firstOrCreate(['jobs_id' => $id]);
            $view->count++;
            $view->save();
        }
        // if (!empty($request->user_id)) {
        //     $hasApplied = JobCallActivities::where('jobs_id', $id)
        //         ->where('jobseeker_id', $request->user_id)
        //         ->where('Activity_type', "Apply")
        //         ->exists();
        //     //$booking['apply_status'] = $hasApplied;

        //     $hasCalled = JobCallActivities::where('jobs_id', $id)
        //         ->where('jobseeker_id', $request->user_id)
        //         ->where('Activity_type', "call")
        //         ->exists();
        //     $booking['call_status'] = $hasCalled;
        // }



        $items = JobsViewResource::collection($booking);
        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];
        return comman_custom_response($items);
    }

    public function getJobsListBySlugUrl(Request $request)
    {

        $slug = $request->slug;

        $booking = Jobs::where('slug', $slug)->with('getJobDistricts.district');

        // $view = JobsViews::firstOrCreate(['jobs_id' => $booking['id']]);
        // $view->count++;
        // $view->save();

        //$booking = Jobs::with('jobDistricts.district')->where('id', $id);	

        $booking->where('status', 1);

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->paginate($per_page);
        $items = JobsResource::collection($booking);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];

        return comman_custom_response($items);
    }

    public function getJobsListByCity(Request $request)
    {

        $booking = Jobs::where('end_date', '>=', DB::raw('CURRENT_DATE()'));

        if (isset($request->get_type)) {
            $booking->inRandomOrder();
        }

        if (isset($request->education)) {
            $booking->where('education', $request->education);
        }

        if (isset($request->district_id)) {
            if ($request->district_id == 'jobs-in-all-districts') {
                $booking->where('status', 1);
            } else if ($request->district_id == "null") {
                $booking->where('status', 1);
            } else {
                $district =  District::where('slug', $request->district_id)->get();
                $booking->where('status', 1);
                $booking->whereHas('jobDistricts', function ($a) use ($district) {
                    $a->where('district_id', $district[0]->id);
                    $a->orWhere('district_id',  100);
                });
            }
        } else {

            $booking->where('status', 1);
        }

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');


        $per_page = 25;
        $page = 1;

        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }

        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
        }
        $orderBy = 'desc';

        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $items = JobsResource::collection($booking);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];

        return comman_custom_response($items);
    }


    public function getShuffleJobsListByCity(Request $request)
    {

        $booking = Jobs::where('status', 1)->inRandomOrder()->where('end_date', '>=', DB::raw('CURRENT_DATE()'));
        if (isset($request->district_id)) {
            if ($request->district_id == 'jobs-in-all-districts') {

                $booking->where('status', 1);
            } else if ($request->district_id == "null") {
                $booking->where('status', 1);
            } else {
                $district =  District::where('slug', $request->district_id)->get();
                $booking->where('status', 1);
                $booking->whereHas('jobDistricts', function ($a) use ($district) {
                    $a->where('district_id', $district[0]->id);
                    $a->orWhere('district_id',  100);
                });
            }
        } else {

            $booking->where('status', 1);
        }

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        $per_page = 25;
        $page = 1;
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }



        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
        }
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $items = JobsResource::collection($booking);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];

        return comman_custom_response($items);
    }

    public function getJobsListByCityAndCategory(Request $request)
    {
        $booking = Jobs::where('status', 1)->where('end_date', '>=', DB::raw('CURRENT_DATE()'));

        if (isset($request->district_id)) {


            if ($request->district_id == 'jobs-in-all-districts') {


                $booking->where('status', 1);
            } else if ($request->district_id == 'jobs-in-all-districts') {

                $booking->where('jobcategory_id', $request->jobcategory_id);

                $booking->where('status', 1);
            } else if ($request->district_id == "null") {

                $booking->where('status', 1);
            } else {

                $district =  District::where('slug', $request->district_id)->get();
                $booking->where('jobcategory_id', $request->jobcategory_id);
                $booking->where('status', 1);
                $booking->whereHas('jobDistricts', function ($a) use ($district) {
                    $a->where('district_id', $district[0]->id);
                    $a->orWhere('district_id',  100);
                });
            }
        } else {

            $booking->where('status', 1);
        }

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }

        $per_page = 25;
        $page = $request->page;

        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
        }
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $items = JobsResource::collection($booking);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];

        return comman_custom_response($items);
    }

    public function getJobsListByCityAndCategorySlug(Request $request)
    {
        $booking = Jobs::where('status', 1)->where('end_date', '>=', DB::raw('CURRENT_DATE()'));

        if (isset($request->district_id)) {

            if ($request->district_id == 'jobs-in-all-districts' && $request->jobcategory_id == 'all-categories') {

                $booking->where('status', 1);
            } else if ($request->district_id == 'jobs-in-all-districts') {

                $cat = JobsCategory::where('slug', $request->jobcategory_id)->first();
                $booking->where('jobcategory_id', $cat->id);
                $booking->where('status', 1);
            } else if ($request->district_id == "null") {

                $booking->where('status', 1);
            } else if ($request->jobcategory_id == 'all-categories') {

                $district =  District::where('slug', $request->district_id)->get();
                $booking->where('status', 1);
                $booking->whereHas('jobDistricts', function ($a) use ($district) {
                    $a->where('district_id', $district[0]->id);
                    $a->orWhere('district_id',  100);
                });
            } else {

                $cat = JobsCategory::where('slug', $request->jobcategory_id)->first();
                $district =  District::where('slug', $request->district_id)->get();
                $booking->where('jobcategory_id', $cat->id);
                $booking->where('status', 1);
                $booking->whereHas('jobDistricts', function ($a) use ($district) {
                    $a->where('district_id', $district[0]->id);
                    $a->orWhere('district_id',  100);
                });
            }
        } else {

            $booking->where('status', 1);
        }

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }

        $per_page = 25;
        $page = $request->page;

        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
        }
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $items = JobsResource::collection($booking);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];

        return comman_custom_response($items);
    }


    public function getJobsListByUser(Request $request)
    {
        $booking = Jobs::query();


        $booking->whereHas('user', function ($a) use ($request) {
            $a->where('user_id', $request->user_id);
        });


        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $booking->count();
            }
        }
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->paginate($per_page);
        $items = JobsResource::collection($booking);

        //  $response = [
        //   'pagination' => [
        //      'total_items' => $items->total(),
        //       'per_page' => $items->perPage(),
        //      'currentPage' => $items->currentPage(),
        //     'totalPages' => $items->lastPage(),
        //      'from' => $items->firstItem(),
        //      'to' => $items->lastItem(),
        //       'next_page' => $items->nextPageUrl(),
        //        'previous_page' => $items->previousPageUrl(),
        //   ],
        //   'data' => $items,
        // ];

        return comman_custom_response($items);
    }

    public function notifyUsersOfExpiringTodayJobs()
    {
        // Get today's date
        $today = date('Y-m-d');

        // Fetch jobs where 'end_date' is today
        $expiringJobsToday = Jobs::whereDate('end_date', $today)->where('status', '1')->get();

        // Check if the collection is empty
        if ($expiringJobsToday->isEmpty()) {
            // No jobs found
            return response()->json([
                'status' => 'error',
                'message' => 'No jobs found that are expiring today.'
            ]);
        }

        // Loop over the jobs
        foreach ($expiringJobsToday as $job) {
            // Retrieve the user related to the job
            $user = $job->user;

            // Retrieve the user's contact number
            $contactNumber = $user->contact_number;

            // Send a message to the user
            // Note: You'll need to replace 'YOUR_MESSAGE_HERE' with the actual message you want to send
            sendWhatsAppText($job->id, 'today_expiry');
        }
        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Messages sent successfully.'
        ]);
    }


    public function jobsExpire()
    {
        $today = date('Y-m-d');
        $affectedRows = Jobs::whereDate('end_date', $today)
            ->update(['status' => '5']);
        // Return a success response
        if ($affectedRows > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'Jobs expiring today have been marked as expired.'
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'No jobs were found expiring today.'
            ]);
        }
    }

    public function notifyUsersOfExpiringTmrwJobs()
    {
        // Get tomorrow's date
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        // Fetch jobs where 'end_date' is tomorrow
        $expiringJobsTomorrow = Jobs::whereDate('end_date', $tomorrow)->where('status', '1')->get();

        // Check if the collection is empty
        if ($expiringJobsTomorrow->isEmpty()) {
            // No jobs found
            return response()->json([
                'status' => 'error',
                'message' => 'No jobs found that are expiring tomorrow.'
            ]);
        }

        // Loop over the jobs
        foreach ($expiringJobsTomorrow as $job) {
            // Retrieve the user related to the job



            // Send a message to the user
            // Note: You'll need to replace 'YOUR_MESSAGE_HERE' with the actual message you want to send
            sendWhatsAppText($job->id,  'tmrw_expiry');
        }

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Messages sent successfully.'
        ]);
    }
}
