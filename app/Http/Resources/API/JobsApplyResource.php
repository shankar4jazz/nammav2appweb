<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class JobsApplyResource extends JsonResource
{
	
	protected $jobseekerId; // Add a property to store the jobseeker_id

    public function __construct($resource, $jobseekerId)
    {
        parent::__construct($resource);
        $this->jobseekerId = $jobseekerId;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $extention = imageExtention(getSingleMedia($this, 'jobs_image', null));
        $user = new UserResource($this->user);
		
		$latestActivity = $this->jobsActivity
            ->where('jobseeker_id',  $request->jobseeker_id)
            ->sortByDesc('updated_at')
            ->first();
		
		 // Transform the activity to an array or null if no activity is found
        $activityArray = $latestActivity ? [
            'activity_type' => $latestActivity->activity_type,
            'activity_message' => $latestActivity->activity_message,
            'apply_status' => $latestActivity->apply_status,
			'reason' => $latestActivity->reason,
            'datetime' => $latestActivity->datetime
        ] : null;
		
		

        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'job_role'      => $this->job_role,
            'company_name'  => $this->company_name,
            'tamil_job_role'      => $this->tamil_job_role,
            'tamil_company_name'  => $this->tamil_company_name,
            'education'     => $this->education,
            'gender'        => $this->gender,
            'marital_status' => $this->marital_status,
            'experience'    => $this->experience,
            'min_salary'    => $this->min_salary,
            'max_salary'    => $this->max_salary,
            'description'   => $this->description,
            'vacancy'       => $this->vacancy,
            //'country_id'    => $this->country_id,
            'state_id'      => $this->state_id,
            //'district_id'   => $this->district_id,
            //'city_id'       => $this->city_id,
            'state_name'    => optional($this->state)->name,
            'district_id'   => $this->district_id ?? 0,
            'district_name'    => optional($this->district)->name,
            'city_id'       => $this->city_id ?? 0,
            'en_city_name'    => optional($this->city)->name,
            'city_name'    => optional($this->city)->tamil_name,
            'jobcategory_id' => $this->jobcategory_id,
            'company_id' => $this->company_id,
            //'company_name'    => optional($this->company)->name,
            //'plan_id'       => $this->plan_id,
            'plan_name'     => optional($this->jobsPlans)->title,
            'plan_identifier'     => optional($this->jobsPlans)->identifier,
            'view_counts'     => optional($this->views)->count,
            ///'payment_id'       => $this->payment_id,
           // 'payment_status'     => optional($this->jobsPayment)->payment_status,
            //'user_id'       => $this->user_id,
           // 'user_name'     => optional($this->user)->display_name,
          //  'contact_number'    => optional($this->user)->contact_number,
            // 'users'         => $user,
            //'address'       => $this->address,
            //'pincode'       => $this->pincode,
          //  'reason'        => $this->reason,
           // 'status'        => $this->status,
           // 'is_featured'   => $this->is_featured,
          //  'start_date'    => $this->start_date,
         //   'end_date'      => $this->end_date,
            'created_at'    => $this->created_at,
            'updated_at'      => $this->updated_at,
            'contact_number'  => $this->contact_number,
            'job_image'     =>  getSingleMedia($this, 'jobs_image', null),
           
            'activity' =>[$activityArray],
        ];
    }
}
 