<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Resources\API\NewsResource;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function getNewsList(Request $request)
    {       
        $booking = News::withTrashed();        
       
        $booking->where('status', 1);      
       	$per_page = 10;
		$page = $request->page;
		
		$start = ($page-1)*$per_page;

		if(!empty($request->page)){
			
		$page = $request->page;
		
		$start = ($page-1)*$per_page;
			
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
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', 'desc')
                        ->get();
        $items = NewsResource::collection($booking);

        $response = [
           // 'pagination' => [
            //    'total_items' => $items->total(),
             //   'per_page' => $items->perPage(),
             //   'currentPage' => $items->currentPage(),
             //   'totalPages' => $items->lastPage(),
              //  'from' => $items->firstItem(),
             //   'to' => $items->lastItem(),
             //   'next_page' => $items->nextPageUrl(),
            //    'previous_page' => $items->previousPageUrl(),
           // ],
            //'data' => $items,
        ];

        return comman_custom_response($items);
    }
    public function getNewsListTest(Request $request)
    {
        $booking = News::withTrashed();

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

       	$per_page = 10;
		$page = $request->page;
		
		$start = ($page-1)*$per_page;

		if(!empty($request->page)){
			
		$page = $request->page;
		
		$start = ($page-1)*$per_page;
			
		}

        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $booking = $booking->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $items = NewsResource::collection($booking);

        $response = [
            // 'pagination' => [
            //    'total_items' => $items->total(),
            //   'per_page' => $items->perPage(),
            //   'currentPage' => $items->currentPage(),
            //   'totalPages' => $items->lastPage(),
            //  'from' => $items->firstItem(),
            //   'to' => $items->lastItem(),
            //   'next_page' => $items->nextPageUrl(),
            //    'previous_page' => $items->previousPageUrl(),
            // ],
            //'data' => $items,
        ];

        return comman_custom_response($items);
    }

    public function getNewsListByCity(Request $request)
    {       
        $booking = News::withTrashed();        
       
        $booking->where('status', 1);   
        $booking->whereHas('city', function ($a) use ($request) {
            $a->where('city_id', $request->city_id);
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
        $items = NewsResource::collection($booking);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);
    }

    public function getNewsListByCategory(Request $request)
    {       
    
        $booking = News::withTrashed()->where("news_category_id", $request->category_id);        
       
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
        $items = NewsResource::collection($booking);

       // $response = [
            // 'pagination' => [
            //     'total_items' => $items->total(),
            //     'per_page' => $items->perPage(),
            //     'currentPage' => $items->currentPage(),
            //     'totalPages' => $items->lastPage(),
            //     'from' => $items->firstItem(),
            //     'to' => $items->lastItem(),
            //     'next_page' => $items->nextPageUrl(),
            //     'previous_page' => $items->previousPageUrl(),
            // ],
            //'data' => $items,
        //];

        return comman_custom_response($items);
    }

    public function getNewsListByUser(Request $request)
    {       
        $booking = News::withTrashed();     
       
        $booking->where('status', 1);   
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
        $items = NewsResource::collection($booking);

        $response = [
            'pagination' => [
                'total_items' => $items->total(),
                'per_page' => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'totalPages' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'next_page' => $items->nextPageUrl(),
                'previous_page' => $items->previousPageUrl(),
            ],
            'data' => $items,
        ];

        return comman_custom_response($response);
    }
}
