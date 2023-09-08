<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Qualification;
use Illuminate\Support\Facades\DB;

class JobseekerController extends Controller
{
    public function getJobseekerDetailsByEducation(Request $request)
    {
        $id = $request->qualification_id;
        if ($request->has('qualification_id') && $request->qualification_id != null) {
            $user = User::where('qualification_id', $id)
                ->select('id', 'username', 'first_name', 'last_name', 'email', 'contact_number', 'display_name', 'address', 'details', 'qualification_id')
                ->with(['city'])
                ->first();

            $message = __('messages.detail');
            if (empty($user)) {
                $message = __('messages.user_not_found');
                return comman_message_response($message, 400);
            }
            $user['profile_image'] = getSingleMedia($user, 'profile_image', null);
            $user['resume'] = getSingleMedia($user, 'resume', null);
            // Attempt to retrieve the qualification separately
            $qualification = Qualification::find($user->qualification_id);

            if ($qualification) {
                $user['qualification_name'] = $qualification->name;
                $user['qualification_short_name'] = $qualification->short_name; // Replace 'name' with the actual column you want from the qualification table
            } else {
                $user['qualification_name'] = 'No qualification found';
                $user['qualification_short_name'] = '';
            }

            unset($user['media']);
            $response = $user;

            return comman_custom_response($response, 200);
        } else {
            $message = __('Invaild Request');
            return comman_message_response($message, 400);
        }
    }

    public function getJobseekerDetailsByJobcategory33(Request $request)
    {

        // $id = 12; 
        // $user = DB::table('users')
        //     ->where('id', $id)
        //     ->select(DB::raw('JSON_EXTRACT(details, "$.job_category") AS job_category'))
        //     ->first();

        // if ($user && $user->job_category) {
        //     $data = json_decode(json_decode($user->job_category), true);           

        //     if (is_array($data)) {
        //         $ids = array_map(function ($item) {
        //             return ['id' => $item['id']];
        //         }, $data);

        //         $newJson = json_encode($ids);

        //         // Update the job_categories column for the specific user
        //         DB::table('users')
        //             ->where('id', $id)
        //             ->update(['job_categories' => $newJson]);
        //     }
        // }

        $users = DB::table('users')
            ->select('id', DB::raw('JSON_EXTRACT(details, "$.districts") AS districts'))
            ->whereNotNull(DB::raw('JSON_EXTRACT(details, "$.districts")'))
            ->get();

        foreach ($users as $user) {
            $data = json_decode(json_decode($user->districts, true), true);

            if (is_array($data)) {
                $ids = array_map(function ($item) {
                    return isset($item['id']) ? ['id' => $item['id']] : null;
                }, $data);

                $ids = array_filter($ids);

                $newJson = json_encode($ids);

                // Update the job_categories column for the specific user
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['districts' => $newJson]);
            }
        }
    }

    public function getJobseekerDetailsByJobcategory(Request $request)
    {
        $id = $request->job_category;
        // Define the number of items per page
        $perPage = $request->input('per_page', 15); // Default to 15 items per page

        if ($request->has('job_category') && $request->job_category != null) {

            $usersQuery = User::whereRaw("JSON_CONTAINS(job_categories, '{\"id\":$id}')")
                ->select('id', 'username', 'first_name', 'last_name', 'email', 'contact_number', 'display_name', 'address', 'details', 'qualification_id')
                ->with(['city']);

            $per_page = config('constant.PER_PAGE_LIMIT');

            if ($request->has('per_page') && !empty($request->per_page)) {
                if (is_numeric($request->per_page)) {
                    $per_page = $request->per_page;
                }
                if ($request->per_page === 'all') {
                    $per_page = $usersQuery->count();
                }
            }

            $users = $usersQuery->paginate($per_page);

            if ($users->isEmpty()) {
                $message = __('messages.user_not_found');
                return comman_message_response($message, 400);
            }

            if ($users->isEmpty()) {
                $message = __('messages.user_not_found');
                return comman_message_response($message, 400);
            }

            foreach ($users as $user) {
                $user['profile_image'] = getSingleMedia($user, 'profile_image', null);
                $user['resume'] = getSingleMedia($user, 'resume', null);

                // Attempt to retrieve the qualification separately
                $qualification = Qualification::find($user->qualification_id);

                if ($qualification) {
                    $user['qualification_name'] = $qualification->name;
                    $user['qualification_short_name'] = $qualification->short_name; // Replace 'name' with the actual column you want from the qualification table
                } else {
                    $user['qualification_name'] = 'No qualification found';
                    $user['qualification_short_name'] = '';
                }

                unset($user['media']);
            }



            return comman_custom_response($users, 200);

            // Return the paginated results
            // return response()->json([
            //     'data' => $users->items(),
            //     'pagination' => [
            //         'total' => $users->total(),
            //         'per_page' => $users->perPage(),
            //         'current_page' => $users->currentPage(),
            //         'last_page' => $users->lastPage(),
            //         'next_page_url' => $users->nextPageUrl(),
            //         'prev_page_url' => $users->previousPageUrl(),
            //         'from' => $users->firstItem(),
            //         'to' => $users->lastItem(),
            //     ]
            // ], 200);

        } else {
            $message = __('Invaild Request');
            return comman_message_response($message, 400);
        }
    }

    public function getJobseekerDetailsByJobcategories(Request $request)
    {
        $users = DB::table('users')
            ->select('id', DB::raw('JSON_EXTRACT(details, "$.job_category") AS job_category'))
            ->whereNotNull(DB::raw('JSON_EXTRACT(details, "$.job_category")'))
            ->get();

        foreach ($users as $user) {
            $data = json_decode(json_decode($user->job_category, true), true);

            if (is_array($data)) {
                $ids = array_map(function ($item) {
                    return isset($item['id']) ? ['id' => $item['id']] : null;
                }, $data);

                $ids = array_filter($ids);

                $newJson = json_encode($ids);

                // Update the job_categories column for the specific user
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['job_categories' => $newJson]);
            }
        }
    }

    //     public function getJobseekerDetailsByJobcategory(Request $request)
    // {
    //     $results = DB::table('users')
    //         ->select(DB::raw('JSON_EXTRACT(details, "$.job_category") AS job_category, first_name, display_name'))
    //         ->get();

    //         $jobCategories = $results->pluck('job_category')->toArray();



    //         $filteredUsers = $results->filter(function ($user) {
    //             $jobCategories = json_decode($user->job_category);      

    //             // Debugging: Check if jobCategories is an array after json_decode
    //             var_dump(is_array($jobCategories));

    //             if (is_array($jobCategories)) {
    //                 foreach ($jobCategories as $category) {
    //                     if (isset($category->id) && $category->id == 5) {
    //                         return true;
    //                     }
    //                 }
    //             }
    //             return false;
    //         });

    //         var_dump($jobCategories);
    //         exit();

    //     // Collect the first_name and display_name of the filtered users
    //     $output = $filteredUsers->map(function ($user) {
    //         return [
    //             'First Name' => $user->first_name,
    //             'Display Name' => $user->display_name
    //         ];
    //     });

    //     return response()->json($output);
    // }


    //     public function getJobseekerDetailsByJobcategory(Request $request)
    //     {

    //         $results = DB::table('users')
    //         ->select(DB::raw('JSON_EXTRACT(details, "$.job_category") AS job_category, first_name, display_name'))
    //         ->get();

    //     $jobCategories = $results->pluck('job_category')->toArray();

    //     $filteredUsers = $results->filter(function ($user) {

    //         $jobCategories = json_decode($user->job_category);       
    //         if (is_array($jobCategories)) {
    //             foreach ($jobCategories as $category) {
    //                 var_dump($category);
    //                 if (isset($category->id) && $category->id == 5) {
    //                     return true;
    //                 }
    //             }
    //         }
    //         return false;

    //     });
    //    // var_dump($filteredUsers);
    //     // Display the first_name and display_name of the filtered users
    //     foreach ($filteredUsers as $user) {
    //         echo "First Name: " . $user->first_name . ", Display Name: " . $user->display_name . "<br>";
    //     }


    //         exit();


    //         $results = DB::table('users')
    //             ->select(DB::raw('JSON_EXTRACT(details, "$.job_category") AS job_category, first_name, display_name'))
    //             ->get();
    //         $jobCategories = $results->pluck('job_category')->toArray();
    //         $decodedJobCategories = collect($jobCategories)->map(function ($jobCategory) {
    //             return json_decode($jobCategory);  // Decodes to an associative array
    //         })->all();

    //         $filteredCategories = array_filter($decodedJobCategories, function ($category) {

    //             $data = json_decode($category);

    //             // Check if the categor;y is an array (because it can be null or empty string)
    //             if (is_array($data)) {

    //                 foreach ($data as $item) {

    //                     if (isset($item->id) && $item->id == 5) {
    //                         return true;
    //                     }
    //                 }
    //             }
    //             return false;
    //         });

    //         var_dump($filteredCategories);
    //         exit();

    //         $id = $request->id;  // Get the ID from the request

    //         $users = User::all();

    //         $matchingUsers = $users->filter(function ($user) use ($id) {
    //             $details = json_decode($user->details, true);
    //             $jobCategory = $details['job_category'] ?? null;

    //             return $jobCategory && isset($jobCategory['id']) && $jobCategory['id'] == $id;
    //         })->all();

    //         // Now, $matchingUsers contains all users with the specified job_category ID
    //         var_dump($matchingUsers);
    //         exit();

    //         if ($users->isEmpty()) {
    //             $message = __('messages.user_not_found');
    //             return comman_message_response($message, 400);
    //         }

    //         foreach ($users as $user) {
    //             $user['profile_image'] = getSingleMedia($user, 'profile_image', null);
    //             $user['resume'] = getSingleMedia($user, 'resume', null);

    //             // Attempt to retrieve the qualification separately
    //             $qualification = Qualification::find($user->qualification_id);

    //             if ($qualification) {
    //                 $user['qualification_name'] = $qualification->name;
    //             } else {
    //                 $user['qualification_name'] = 'No qualification found';
    //             }

    //             unset($user['media']);
    //         }

    //         // Return the paginated results
    //         return response()->json([
    //             'data' => $users->items(),
    //             'pagination' => [
    //                 'total' => $users->total(),
    //                 'per_page' => $users->perPage(),
    //                 'current_page' => $users->currentPage(),
    //                 'last_page' => $users->lastPage(),
    //                 'next_page_url' => $users->nextPageUrl(),
    //                 'prev_page_url' => $users->previousPageUrl(),
    //                 'from' => $users->firstItem(),
    //                 'to' => $users->lastItem(),
    //             ]
    //         ], 200);
    //     }
}
