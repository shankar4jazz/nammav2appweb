<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobsPayment;
use App\Models\Jobs;
use App\Http\Resources\API\PaymentResource;
use Braintree;

class JobsPaymentController extends Controller
{
    public function savePayment(Request $request)
    {
        $data = $request->all();
        $data['datetime'] = isset($request->datetime) ? date('Y-m-d H:i:s',strtotime($request->datetime)) : date('Y-m-d H:i:s');
        $result = JobsPayment::updateOrCreate(['job_id' => $data['job_id']],$data);

        $startDate = date('Y-m-d'); // use the current date as the start date
        $endDate = date('Y-m-d', strtotime($startDate . ' + '.$request->trial_period.' days')); // add 30 days to the start date to get the end date
    
        $booking = Jobs::find($request->job_id);
        $booking->payment_id = $result->id;
        $booking->end_date = $endDate;
        $booking->plan_id = $request->plan_id;
        $booking->save();
        $status_code = 200;
        if($result->payment_status == 'paid'){
            $message = __('messages.payment_completed');
            sendWhatsAppText($result->id, $result->user_id, $result->payment_status);
        } else {
            $message = __('messages.payment_message',['status' => __('messages.'.$result->payment_status) ]);
        }

        if($result->payment_status == 'failed')
        {
            $status_code = 200;
            sendWhatsAppText($result->id, $result->user_id, $result->payment_status);
        }      
        return comman_message_response($message,$status_code);
    }

    public function paymentList(Request $request)
    {
        $payment = JobsPayment::myPayment()->with('booking');

        $per_page = config('constant.PER_PAGE_LIMIT');
        if( $request->has('per_page') && !empty($request->per_page)){
            if(is_numeric($request->per_page)){
                $per_page = $request->per_page;
            }
            if($request->per_page === 'all' ){
                $per_page = $payment->count();
            }
        }

        $payment = $payment->orderBy('id','desc')->paginate($per_page);
        $items = PaymentResource::collection($payment);

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