<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class JobsPlanCategoryResource extends JsonResource
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
            'id'                    => $this->id,
            'en_name'               => $this->en_name,
            'ta_namer'              => $this->ta_name,
            'en_description'        => $this->en_description,
            'ta_description'        => $this->ta_description,
            'plan_type'             => $this->plan_type,
            'icon'                  => getSingleMedia($this, 'jobs_plans_category_image', null),
            'plan_details' => $this->getPlans,
            //'plan_limitation'   => optional($this->planlimit)->plan_limitation
        ];
    }
}
