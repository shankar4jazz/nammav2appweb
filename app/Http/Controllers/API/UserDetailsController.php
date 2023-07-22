<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Http\Resources\API\CompanyResource;
use App\Models\WalletHistory;
use App\Http\Resources\API\WalletHistoryResource;

class UserDetailsController extends Controller
{
    public function addUserDetails(Request $request)
    {
        $data = $request->all();   
        $result = UserDetails::updateOrCreate(['user_id' => $data['user_id']], $data);     
        $status_code = 200;          
        return comman_message_response($result, $status_code);
    }
   
    public function getUserDetailsByUser(Request $request)
    {       
        $booking = UserDetails::query();     
       
    	
        $booking->whereHas('users', function ($a) use ($request) {
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
        $items = CompanyResource::collection($booking);

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
