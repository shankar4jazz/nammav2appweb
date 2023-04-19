<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class JobsReportResource extends JsonResource
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
            'id'            => $this->id,
            'job_id'          => $this->jobs_id,
            'jobseeker_id'        => $this->jobseeker_id,
            'jobseeker_name'        =>optional($this->jobseeker)->first_name,
            'report_type'   => $this->activity_type,
            'report_message'        => $this->activity_message,
        ];
    }
}
