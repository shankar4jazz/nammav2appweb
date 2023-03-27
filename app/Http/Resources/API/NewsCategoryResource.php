<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $extention = imageExtention(getSingleMedia($this, 'jobs_category_image',null));
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'tamil_name'    => $this->tamil_name,
            'status'        => $this->status,
            'description'   => $this->description,
            'is_featured'   => $this->is_featured,
            'color'         => $this->color,
            'jobcategory_image'=> getSingleMedia($this, 'jobs_category_image',null),
            'category_extension' => $extention,
            
            'deleted_at'        => $this->deleted_at,
        ];
    }
}
