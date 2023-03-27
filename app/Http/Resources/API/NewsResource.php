<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $extention = imageExtention(getSingleMedia($this, 'jobs_image', null));
        //$user = new UserResource($this->user);
        $user = new UserResource($this->user);
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'link'          => $this->link,
            'tamil_title'   => $this->tamil_title,
            'news_category_id'      => $this->news_category_id,
            'news_subcategory_id'   => $this->news_subcategory_id,
            'news_image' => getSingleMedia($this, 'news_image', null),
            'news_video' => getSingleMedia($this, 'news_video', null),
			

            'user_id'       => $this->user_id,
			'user_name'    => optional($this->user)->display_name,
            'youtube_url'   => $this->youtube_url,
            'state_id'      => $this->state_id,
            'state_name'    => optional($this->state)->name,
            'district_id'   => $this->district_id,
            'district_name'    => optional($this->district)->name,
            'city_id'       => $this->city_id,
            'city_name'    => optional($this->city)->name,
            'country_id'    => $this->country_id,
            'description'   => $this->description,
            'status'        => $this->status,
            'is_featured'   => $this->is_featured,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'reject_reason' => $this->reject_reason,
        ];
    }
}
