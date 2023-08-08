<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Http\Resources\API\QualificationResource;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
{
    public function getQualificationsList(Request $request)
    {
        $qualifications = Qualification::query();

        if ($request->has('category_id')) {
            $category_id = $request->category_id;
            $qualifications->where('category_id', $category_id);
        }

        $per_page = config('constant.PER_PAGE_LIMIT');
        $page = 1;
        if ($request->has('per_page') && !empty($request->per_page)) {
            if (is_numeric($request->per_page)) {
                $per_page = $request->per_page;
            }
            if ($request->per_page === 'all') {
                $per_page = $qualifications->count();
            }
        }

        
        $start = ($page - 1) * $per_page;

        if (!empty($request->page)) {

            $page = $request->page;

            $start = ($page - 1) * $per_page;
        }

        $orderBy = 'desc';
        if ($request->has('orderby') && !empty($request->orderby)) {
            $orderBy = $request->orderby;
        }

        $qualifications = $qualifications
            ->orderBy('updated_at', $orderBy)
            ->offset($start)
            ->limit($per_page)
            ->get();

        $items = QualificationResource::collection($qualifications);

        return comman_custom_response($items);
    }
    
    // Add more methods for CRUD operations if needed
}
