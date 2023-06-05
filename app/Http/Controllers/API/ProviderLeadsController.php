<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderLeads;

use App\Http\Resources\API\PaymentResource;
use Braintree;

class ProviderLeadsController extends Controller
{
    public function saveLeads(Request $request)
    {
        $data = $request->all();        
        $result = ProviderLeads::create($data);
        
      
        if($result){
            $status_code = 200;
            $message = __('Success');
        } else {
            $status_code = 400;
            $message = __('Failed');
        }

        return comman_message_response($message,$status_code);
    }

    // public function paymentList(Request $request)
    // {
    //     $payment = Payment::myPayment()->with('booking');

    //     $per_page = config('constant.PER_PAGE_LIMIT');
    //     if( $request->has('per_page') && !empty($request->per_page)){
    //         if(is_numeric($request->per_page)){
    //             $per_page = $request->per_page;
    //         }
    //         if($request->per_page === 'all' ){
    //             $per_page = $payment->count();
    //         }
    //     }

    //     $payment = $payment->orderBy('id','desc')->paginate($per_page);
    //     $items = PaymentResource::collection($payment);

    //     $response = [
    //         'pagination' => [
    //             'total_items' => $items->total(),
    //             'per_page' => $items->perPage(),
    //             'currentPage' => $items->currentPage(),
    //             'totalPages' => $items->lastPage(),
    //             'from' => $items->firstItem(),
    //             'to' => $items->lastItem(),
    //             'next_page' => $items->nextPageUrl(),
    //             'previous_page' => $items->previousPageUrl(),
    //         ],
    //         'data' => $items,
    //     ];
        
    //     return comman_custom_response($response);
    // }
}