<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageListsResource extends JsonResource
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
            'id'                 => $this->id,
            'title'              => $this->title,
            'imageurl'           => $this->image,
            'description'        => $this->description,
            'payload'            => $this->payload,
            'topics'             => $this->device_id,
                        //'plan_limitation'   => optional($this->planlimit)->plan_limitation
        ];
    }
}
