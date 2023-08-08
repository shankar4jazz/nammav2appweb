<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class QualificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category_id' => $this->category_id,
           
        ];
    }
}
