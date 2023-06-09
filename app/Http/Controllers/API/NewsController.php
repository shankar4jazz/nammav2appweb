<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Resources\API\NewsResource;
use Carbon\Carbon;

class NewsController extends Controller
{

    public function saveNews(Request $request)
    {
        $data = $request->all();

      
        $data['description'] = base64_encode($request->description);
        $result = News::create($data);
        storeMediaFile($result, $request->news_image, 'news_image');
        $status_code = 200;
        if ($result) {
            $status_code = 200;
            $message = __('News published');
        } else {
            $status_code = 400;
            $message = __("News not published");
        }

       
        return comman_message_response($message, $status_code);
    }
    public function getNewsList(Request $request)
    {
        $booking = News::withoutTrashed();

        $booking->where('status', 1);
        $per_page = 100;
        $page = $request->page;

        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
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

        // $booking = $booking->orderBy('updated_at', 'desc')->get();
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
    public function getNewsListTest(Request $request)
    {
        $booking = News::withoutTrashed();

        $booking->where('status', 1);

        //$service = Service::where('service_type','service')->withTrashed()->with(['providers','category','serviceRating']);

        $per_page = config('constant.PER_PAGE_LIMIT');
        $per_page = 50;
        $page = $request->page;
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
        $booking = News::withoutTrashed();

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
        $per_page = 50;
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

        $booking = News::withoutTrashed()->where("news_category_id", $request->category_id);

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
        $per_page = 50;
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
        $booking = News::withoutTrashed();

       
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

    public function getAllNewsList(Request $request)
    {
        $booking = News::withoutTrashed();
        $booking->where('status', 1);

        if (!empty($request->page)) {

            $page = $request->page;
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
        $start = ($page - 1) * $per_page;
        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }
        $daysAgo = 15;
        $dateThreshold = Carbon::now()->subDays($daysAgo);

        //$booking = $booking->where('id', $request->news_id)->where('updated_at', '>=', $dateThreshold)->orderBy('updated_at', $orderBy)->offset($start)->limit($per_page)->get();
        $booking = $booking->where('id', '<=', $request->news_id)->orderBy('id', $orderBy)->offset($start)->limit($per_page)->get();
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
}
