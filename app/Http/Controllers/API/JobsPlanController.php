<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobsPlanCategory;
use App\Models\JobsPlansOrg;
use App\Models\ProviderSubscription;
use App\Http\Resources\API\JobsPlanCategoryResource;
use App\Http\Resources\API\JobsPlanResource;

class JobsPlanController extends Controller
{
    public function jobsPlanList(Request $request)
    {
        $plans = JobsPlanCategory::where('status', 1);
        // $get_user_free_plan = ProviderSubscription::where('user_id', auth()->id())->first();
        // if (!empty($get_user_free_plan)) {
        //     $plans =  $plans->whereNotIn('identifier', ['free']);
        // }
        $orderBy = $request->orderby ? $request->orderby : 'asc';

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $plans->count();
            }
        }

        $plans = $plans->orderBy('id', $orderBy)->paginate($per_page);
        $items = JobsPlanCategoryResource::collection($plans);

        //$response = [
            // 'pagination' => [
            //     'total_items' => $items->total(),
            //     'per_page' => $items->perPage(),
            //     'currentPage' => $items->currentPage(),
            //     'totalPages' => $items->lastPage(),
            //     'from' => $items->firstItem(),
            //     'to' => $items->lastItem(),
            //     'next_page' => $items->nextPageUrl(),
            //     'previous_page' => $items->previousPageUrl(),
            // ],
            //'data' => $items,
       // ];

        return comman_custom_response($items);
    }

    public function planLists(Request $request)
    {
        $plans = JobsPlansOrg::where('status', 1);
        // $get_user_free_plan = ProviderSubscription::where('user_id', auth()->id())->first();
        // if (!empty($get_user_free_plan)) {
        //     $plans =  $plans->whereNotIn('identifier', ['free']);
        // }
        $orderBy = $request->orderby ? $request->orderby : 'asc';

        $per_page = config('constant.PER_PAGE_LIMIT');
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $plans->count();
            }
        }

        $plans = $plans->orderBy('id', $orderBy)->paginate($per_page);
        $items = JobsPlanResource::collection($plans);

        //$response = [
            // 'pagination' => [
            //     'total_items' => $items->total(),
            //     'per_page' => $items->perPage(),
            //     'currentPage' => $items->currentPage(),
            //     'totalPages' => $items->lastPage(),
            //     'from' => $items->firstItem(),
            //     'to' => $items->lastItem(),
            //     'next_page' => $items->nextPageUrl(),
            //     'previous_page' => $items->previousPageUrl(),
            // ],
            //'data' => $items,
       // ];

        return comman_custom_response($items);
    }
}
