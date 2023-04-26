<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Http\Resources\API\JobsResource;
use App\Models\District;
use Carbon\Carbon;

class JobsController extends Controller
{
    public function getJobsList(Request $request)
    {
        $booking = Jobs::where('status', 1);

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

        $booking = Jobs::where('id', (int)$id)->with('getJobDistricts.district');
        //$booking = Jobs::with('jobDistricts.district')->where('id', $id);;


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

    public function getJobsListBySlugUrl(Request $request)
    {

        $slug = $request->slug;

        $booking = Jobs::where('slug', $slug)->with('getJobDistricts.district');
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



        $booking = Jobs::withTrashed();
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

    public function getJobsListByCityAndCategory(Request $request)
    {
        $booking = Jobs::query();

        if (isset($request->district_id)) {
            if ($request->district_id == 'jobs-in-all-districts' && $request->jobcategory_id == 'select-categories') {


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


    public function getJobsListByUser(Request $request)
    {
        $booking = Jobs::where();


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
}
