<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessPayment;
use App\Models\Jobs;
use App\Http\Resources\API\PaymentResource;

class AccessPaymentController extends Controller
{
    public function savePayment(Request $request)
    {
        $data = $request->all();
        $data['datetime'] = isset($request->datetime) ? date('Y-m-d H:i:s', strtotime($request->datetime)) : date('Y-m-d H:i:s');
        $result = AccessPayment::updateOrCreate(['job_id' => $data['job_id']], $data);
        $status_code = 200;

        if ($result->payment_status == 'paid') {
            $message = __('messages.payment_completed');
            // sendWhatsAppText($request->job_id, 'paid');
            // sendWhatsAppTextToExecutivePay($result->job_id, 'paid');
        } else {
            $message = __('messages.payment_message', ['status' => __('messages.' . 'failed')]);
        }

        if ($result->payment_status == 'failed') {
            $status_code = 400;
            //  sendWhatsAppText($request->job_id,  'failed');
        }
        return comman_message_response($message, $status_code);
    }

    public function paymentList(Request $request)
    {
        $payment = AccessPayment::myPayment()->with('booking');

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $payment->count();
            }
        }

        $payment = $payment->orderBy('id', 'desc')->paginate($per_page);
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

    public function checkPayment(Request $request)
    {
        $input = $request->all();
        $user_data = JobsPayment::where('job_id', $input['job_id'])->first();
        if ($user_data != null) {
            $otp_response = [

                'status' => true,
                'is_payment' => true

            ];
            return comman_custom_response($otp_response);
        } else {

            $otp_response = [

                'status' => false,
                'is_payment' => false

            ];
            return comman_custom_response($otp_response);
        }
    }
}
