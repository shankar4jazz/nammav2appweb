<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCallActivities;
use App\Http\Resources\API\JobCallAcitvitiesResource;


class JobCallActivitiesController extends Controller
{
    public function saveCallActivities(Request $request)
    {
        $data = $request->all();
     
        $data['datetime'] = isset($request->datetime) ? date('Y-m-d H:i:s', strtotime($request->datetime)) : date('Y-m-d H:i:s');
        if($data['jobseeker_id'] != ""){
            JobCallActivities::updateOrCreate(['jobseeker_id' => $data['jobseeker_id']], $data);
        }
        else{
            JobCallActivities::create($data);

        }
     
        

        $status_code = 200;

        $message = "save successfully";

        return comman_message_response($message, $status_code);
    }

    public function getCallActivitiesByJobId(Request $request){

        $document = JobCallActivities::where('jobs_id',$request->jobs_id);
       
        $per_page = config('constant.PER_PAGE_LIMIT');
        if( $request->has('per_page') && !empty($request->per_page)){
            if(is_numeric($request->per_page)){
                $per_page = $request->per_page;
            }
            if($request->per_page === 'all' ){
                $per_page = $document->count();
            }
        }
        $document = $document->orderBy('created_at','desc')->paginate($per_page);
        $items = JobCallAcitvitiesResource::collection($document);

        // $response = [
        //     'pagination' => [
        //         'total_items' => $items->total(),
        //         'per_page' => $items->perPage(),
        //         'currentPage' => $items->currentPage(),
        //         'totalPages' => $items->lastPage(),
        //         'from' => $items->firstItem(),
        //         'to' => $items->lastItem(),
        //         'next_page' => $items->nextPageUrl(),
        //         'previous_page' => $items->previousPageUrl(),
        //     ],
        //     'data' => $items,
        // ];
        
        return comman_custom_response($items);
    }
}
