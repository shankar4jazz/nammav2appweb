<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class JobsPlanResource extends JsonResource
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
            'id'                => $this->id,
            'title'             => $this->title,
            'identifier'        => $this->identifier,
            'amount'            => $this->amount,
            'total_amount'            => $this->total_amount,
            'price'             => $this->price,
            'percentage'        => $this->percentage,
            'tax'               => $this->tax,
            'duration'          => $this->duration,
            'description'       => $this->description,
            'plan_type'         => $this->plan_type,
            'type'              => $this->type,
            'trial_period'      => $this->trial_period,
            //'plan_limitation'   => optional($this->planlimit)->plan_limitation
        ];
    }
}