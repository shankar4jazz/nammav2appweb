<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'booking_id' => $this->booking_id,
            'customer_id'   => $this->customer_id,
            'total_amount'  => $this->total_amount,
            'payment_status'=> $this->payment_status,
            'payment_type'  => $this->payment_type,
            'payment_method'=> $this->payment_type,
            'customer_name' => optional($this->customer)->display_name,
            'taxes'         => json_decode($this->taxes, true),
            'quantity'      => optional($this->booking)->quantity,
            'coupon_data'   => optional($this->booking)->couponAdded,
            'price'         => optional($this->booking->service)->price,
            'discount'      => optional($this->booking->service)->discount,
            'extra_charges' => BookingChargesResource::collection(optional($this->booking)->bookingExtraCharge)
            
        ];
    }
}