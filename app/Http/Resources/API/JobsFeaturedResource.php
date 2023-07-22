<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class JobsFeaturedResource extends JsonResource
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
            'title'         => $this->title,
            'slug'          => $this->slug,
            'job_role'      => $this->job_role,
            'company_name'  => $this->company_name,
            'tamil_job_role'      => $this->tamil_job_role,
            'tamil_company_name'  => $this->tamil_company_name,          
            'job_featured_image'     =>  getSingleMedia($this, 'jobs_featured', null),
           
           
        ];
    }
}
 