<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\AccessPayment;

class JobsResource extends JsonResource
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
        // $user = new UserResource($this->user);

        $applicationCount = $this->jobsActivity->where('jobs_id', $this->id)->count();
        $seekerCount = User::whereRaw("JSON_CONTAINS(job_categories, '{\"id\":$this->jobcategory_id}')")->count();
        $paidRecord = AccessPayment::where('job_id', $this->id)
            ->where('employer_id', $this->user_id)
            ->first();

        $extraPaid = $paidRecord ? $paidRecord->payment_status : "failed";
        $verified = $paidRecord ? $paidRecord->is_verified : 0;

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
            'payment_status'     => optional($this->jobsPayment)->payment_status,
            //'user_id'       => $this->user_id,
            'user_name'     => optional($this->user)->display_name,
            'contact_number'    => optional($this->user)->contact_number,
            // 'users'         => $user,
            'address'       => $this->address,
            'pincode'       => $this->pincode,
            'reason'        => $this->reason,
            'status'        => $this->status,
            'is_featured'   => $this->is_featured,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
            'created_at'    => $this->created_at,
            'updated_at'      => $this->updated_at,
            'contact_number'  => $this->contact_number,
            'job_image'     =>  getSingleMedia($this, 'jobs_image', null),
            'districts' => $this->getJobDistricts->map(function ($jobDistrict) {
                return [
                    'id' => $jobDistrict->district->id ?? '',
                    'name' => $jobDistrict->district->name ?? '',
                    'dt_name_tamil' => $jobDistrict->district->dt_name_tamil ?? ''
                    // Add other district fields as needed
                ];
            }),
            'disclose_salary' => $this->disclose_salary,
            'disclose_company' => $this->disclose_company,
            'view_application_count' => $applicationCount,
            'view_seeker_count' => $seekerCount,
            'extra_paid' => $extraPaid,
            'is_verified' => $verified

            // 'apply_list' => $this->jobsActivity->map(function ($jobDistrict) {
            //     return [
            //         'jobseeker_id' => $jobDistrict->jobseeker->id?? '',                   
            // 		'activity_type' => $jobDistrict->jobseeker->activity_type?? '',
            //         'name' => $jobDistrict->jobseeker->first_name ?? '' 

            //         // Add other district fields as needed
            //     ];
            // }),
            // 'apply_status'     => optional($this->jobsActivity)->jobseeker_id,
        ];
    }
}
