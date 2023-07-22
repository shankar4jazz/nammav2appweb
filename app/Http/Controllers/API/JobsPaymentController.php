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
        $data['datetime'] = isset($request->datetime) ? date('Y-m-d H:i:s', strtotime($request->datetime)) : date('Y-m-d H:i:s');
        $result = JobsPayment::updateOrCreate(['job_id' => $data['job_id']], $data);


        $booking = Jobs::find($request->job_id);
        $booking->payment_id = $result->id;
        if (isset($data['status'])) {
            $booking->status = $data['status'];
        }

        $booking->plan_id = $request->plan_id;

        $status_code = 200;
        if ($result->payment_status == 'paid') {
            $startDate = date('Y-m-d'); // use the current date as the start date
            $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $request->trial_period . ' days')); // add 30 days to the start date to get the end date

            $booking->end_date = $endDate;
            $booking->save();
            $message = __('messages.payment_completed');
            sendWhatsAppText($booking->id, 'paid');
            sendWhatsAppTextToExecutivePay($result->job_id, 'paid');
        } else {
            $message = __('messages.payment_message', ['status' => __('messages.' . $result->payment_status)]);
        }

        if ($result->payment_status == 'failed') {
            $status_code = 400;
            $booking->save();
            sendWhatsAppText($booking->id,  'failed');
        }
        return comman_message_response($message, $status_code);
    }

    public function paymentList(Request $request)
    {
        $payment = JobsPayment::myPayment()->with('booking');

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
