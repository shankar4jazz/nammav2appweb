<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $providers_service_rating = (float) 0;
        $handyman_rating = (float) 0;
        $is_verify_provider = false;
        if($this->user_type == 'provider')
        {
            $providers_service_rating = (isset($this->getServiceRating) && count($this->getServiceRating) > 0 ) ? (float) number_format(max($this->getServiceRating->avg('rating'),0), 2) : 0;
            $is_verify_provider = verify_provider_document($this->id);
            $handyman_rating = (isset($this->handymanRating) && count($this->handymanRating) > 0 ) ? (float) number_format(max($this->handymanRating->avg('rating'),0), 2) : 0;

        }
        if($this->user_type == 'handyman')
        {
            $handyman_rating = (isset($this->handymanRating) && count($this->handymanRating) > 0 ) ? (float) number_format(max($this->handymanRating->avg('rating'),0), 2) : 0;
        }
        $profile_image = "";
        if($this->login_type != null){
            $profile_image = $this->social_image;
        }else{
            $profile_image = getSingleMedia($this, 'profile_image',null);
        }  
        return [
            
            'id'                => $this->id,
            'username'          => $this->username,
            'provider_id'       => $this->provider_id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'display_name'      => $this->first_name .' '. $this->last_name,
            'status'            => $this->status,
            'description'       => $this->description,
            'user_type'         => $this->user_type,
            'email'             => $this->email,
            'contact_number'    => $this->contact_number,
            'country_id'        => $this->country_id,
            'state_id'          => $this->state_id,
            'city_id'           => $this->city_id,            
            'address'           => $this->address,
            'status'            => $this->status,
            'providertype_id'   => $this->providertype_id,
            'providertype'      => optional($this->providertype)->name,
            'is_featured'       => $this->is_featured,         
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'deleted_at'        => $this->deleted_at,
            'profile_image'     => $profile_image,
            'time_zone'         => $this->time_zone,
            'uid'               => $this->uid,
            'login_type'        => $this->login_type,
            'service_address_id'=> $this->service_address_id,
            'last_notification_seen'   => $this->last_notification_seen,
            'providers_service_rating' => $providers_service_rating,
            'handyman_rating'          => $handyman_rating,
            'is_verify_provider'       => (int) $is_verify_provider,
            'isHandymanAvailable'      => $this->is_available,
            'designation'              => $this->designation,
			'otp'                      =>$this->otp,
            'otp_attempt'              =>$this->otp_attempt,
            'handymantype_id' => $this->handymantype_id,
            'handymantype' => optional($this->handymantype)->name,
          
        ];
    }
}
