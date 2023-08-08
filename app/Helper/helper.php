<?php

use \Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;


function authSession($force = false)
{
    $session = new \App\Models\User;
    if ($force) {
        $user = \Auth::user()->getRoleNames();
        \Session::put('auth_user', $user);
        $session = \Session::get('auth_user');
        return $session;
    }
    if (\Session::has('auth_user')) {
        $session = \Session::get('auth_user');
    } else {
        $user = \Auth::user();
        \Session::put('auth_user', $user);
        $session = \Session::get('auth_user');
    }
    return $session;
}

function comman_message_response($message, $status_code = 200)
{
    return response()->json(['message' => $message], $status_code);
}

function comman_custom_response($response, $status_code = 200)
{
    return response()->json($response, $status_code);
}

function comman_list_response($data)
{
    return response()->json(['data' => $data]);
}


function checkMenuRoleAndPermission($menu)
{
    if (\Auth::check()) {
        if ($menu->data('role') == null && auth()->user()->hasRole('executive') || auth()->user()->hasRole('admin')) {
            return true;
        }

        if ($menu->data('permission') == null && $menu->data('role') == null) {
            return true;
        }

        if ($menu->data('role') != null) {
            if (auth()->user()->hasAnyRole(explode(',', $menu->data('role')))) {
                return true;
            }
        }

        if ($menu->data('permission') != null) {
            if (is_array($menu->data('permission'))) {
                if (auth()->user()->hasAnyPermission($menu->data('permission'))) {
                    return true;
                }
            }
            if (auth()->user()->can($menu->data('permission'))) {
                return true;
            }
        }
    }

    return false;
}


function checkRolePermission($role, $permission)
{
    try {
        if ($role->hasPermissionTo($permission)) {
            return true;
        }
        return false;
    } catch (Exception $e) {
        return false;
    }
}

function demoUserPermission()
{
    if (\Auth::user()->hasAnyRole(['demo_admin'])) {
        return true;
    } else {
        return false;
    }
}

function UserPermission()
{
    if (\Auth::user()->hasAnyRole(['executive', 'admin'])) {
        return true;
    } else {
        return false;
    }
}



function getSingleMedia($model, $collection = 'profile_image', $skip = true)
{
    if (!\Auth::check() && $skip) {
        return asset('images/user/user.png');
    }
    $media = null;
    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }

    if ($media !== null) {
        // Assuming the media disk is set to 's3'
        $disk = $media->disk;
        // Generate the Cloudflare R2 URL based on the disk and path
        $cloudflareR2Url = getCloudflareR2Url($media);
        return $cloudflareR2Url;
    }

    if (getFileExistsCheck($media)) {

      
       //d Generate the Cloudflare R2 URL based on the disk and path
        $cloudflareR2Url = getCloudflareR2Url($media);
        return $cloudflareR2Url;
       // return $media->getFullUrl();
    } else {

        switch ($collection) {
            case 'image_icon':
                $media = asset('images/user/user.png');
                break;
            case 'profile_image':
                $media = asset('images/user/user.png');
                break;
            case 'service_attachment':
                $media = asset('images/default.png');
                break;
            case 'site_logo':
                $media = asset('images/logo.png');
                break;
            case 'site_favicon':
                $media = asset('images/favicon.png');
                break;
            case 'app_image':
                $media = asset('images/frontend/mb-serv-1.png');
                break;
            case 'app_image_full':
                $media = asset('images/frontend/mb-serv-full.png');
                break;
            case 'news_image':
                $media = '';
                break;
            case 'news_video':
                $media = '';
                break;
            default:
                $media = asset('images/default.png');
                break;
        }
        return $media;
    }
}

function getFileExistsCheck($media)
{
    $mediaCondition = false;

    if ($media) {
        if ($media->disk == 'public') {
            $mediaCondition = file_exists($media->getPath());
        } else {
            $mediaCondition = \Storage::disk($media->disk)->exists($media->getPath());
        }
    }
    return $mediaCondition;
}



function storeAudioFile($model, $file, $name)
{
    if ($file) {
        if (!in_array($name, ['voice_notes'])) {
            $model->clearMediaCollection($name);
        }
        if (is_array($file)) {
            foreach ($file as $key => $value) {
                $model->addMedia($value)->toMediaCollection($name, 's3');
                
            }
        } else {
            // Remove the image resizing code
            $model->addMedia($file)->toMediaCollection($name, 's3');
           
        }
    }
    return true;
}

function storeMediaFile($model, $file, $name)
{
    if ($file) {
        if (!in_array($name, ['service_attachment'])) {
            $model->clearMediaCollection($name);
        }
        if (is_array($file)) {
            foreach ($file as $key => $value) {
                // $img = \Image::make($value->getPathname());
                // // Generate a unique filename for the resized image
                // $resizedFilename = $value->getClientOriginalName();
                // // Get the directory path of the original image
                // $originalDirectory = pathinfo($value->getPathname(), PATHINFO_DIRNAME);
                // // Generate the path for the resized image
                // $resizedPath = $originalDirectory . '/' . $resizedFilename;
                // // Resize the image to a specific size and save it to the new path
                // $img->resize(300, 215)->save($resizedPath, 90);
                // // Check the file size and reduce the quality further if needed
                // // while (filesize($file->getPathname()) > 10240) {
                // //     $data = $img->encode('jpg', $img->getEncodedQuality() - 10);
                // //    // $img->save($file->getPathname(), $img->getEncodedQuality() - 10);
                // // }
                // // Add the resized image to the same media object
                // $model->addMedia($resizedPath)
                //     ->usingFileName($resizedFilename)
                //     ->toMediaCollection($name);
                // uploadToCloudflareR2Helper($file);

                $resizedImageData = resizedImage($value); // Call the resizedImage function to get the resized image data

                // Store the resized image in Cloudflare R2
                //storeInCloudflareR2($resizedImageData['path'], $resizedImageData['filename']);
    
                // Delete the temporary file
    
    
                $model->addMedia($resizedImageData['path'])
                    ->toMediaCollection($name, 's3');
    
                File::delete($resizedImageData['path']);
                //$model->addMedia($value)->toMediaCollection($name);
            }
        } else {
            // $mediaItem = $model->addMedia($file)->toMediaCollection();
            // $img = \Image::make($file->getPathname());
            // // Generate a unique filename for the resized image
            // $resizedFilename = $file->getClientOriginalName();
            // // Get the directory path of the original image
            // $originalDirectory = pathinfo($file->getPathname(), PATHINFO_DIRNAME);
            // // Generate the path for the resized image
            // $resizedPath = $originalDirectory . '/' . $resizedFilename;
            // // Resize the image to a specific size and save it to the new path
            // $img->resize(300, 215)->save($resizedPath, 90);
            // // Check the file size and reduce the quality further if needed
            // // while (filesize($file->getPathname()) > 10240) {
            // //      $data = $img->encode('jpg', $img->getEncodedQuality() - 10);
            // //      $img->save($file->getPathname(), $img->getEncodedQuality() - 10);
            // // }
            // // Add the resized image to the same media object            
            // $media = $model->addMedia($resizedPath)->usingFileName($resizedFilename)->toMediaCollection($name);
            // uploadToCloudflareR2Helper($media);

            // $img = \Image::make($file->getPathname());
            // $resizedFilename = $file->getClientOriginalName();
            // $originalDirectory = pathinfo($file->getPathname(), PATHINFO_DIRNAME);

            // $resizedPath = $originalDirectory . '/' . $resizedFilename;
            // $img->resize(300, 215)->save($resizedPath, 90);   

            // $model->addMedia($resizedPath)
            //     ->usingFileName($resizedFilename)
            //     ->toMediaCollection($name);

            // // Clean up the resized image from the local storage
            // unlink($resizedPath);

            $resizedImageData = resizedImage($file); // Call the resizedImage function to get the resized image data

            // Store the resized image in Cloudflare R2
            //storeInCloudflareR2($resizedImageData['path'], $resizedImageData['filename']);

            // Delete the temporary file


            $model->addMedia($resizedImageData['path'])
                ->toMediaCollection($name, 's3');

            File::delete($resizedImageData['path']);
        }
    }

    return true;
}

// Example function to store the image in Cloudflare R2
function storeInCloudflareR2($image, $filename)
{
    $disk = \Storage::disk('s3');

    $disk->put($filename, $image, 'public');
    // Return the URL to the image

}

// Example function to get the Cloudflare R2 URL
function getCloudflareR2Url($model)
{

    // var_dump($model->id);
    // exit();

    return env('R2_URL')."/{$model->id}/{$model->file_name}";
}

function resizedImage($file)
{
    $mobileWidth = 800;
    $mobileHeight = 600;

    $img = \Image::make($file)
        ->resize($mobileWidth, $mobileHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->encode();
    // $img = \Image::make($file->getPathname());
    // $img->resize(800, 600);

    // Generate a unique filename for the resized image with the correct file extension
    $newFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension();

    // Generate a temporary file path
    $tempFilePath = sys_get_temp_dir() . '/' . $newFilename;

    // Save the image to the temporary file path
    $img->save($tempFilePath, 90);

    // Convert the image to WebP format
    $webpFilename = pathinfo($newFilename, PATHINFO_FILENAME) . '.webp';
    $webpFilePath = sys_get_temp_dir() . '/' . $webpFilename;
    $img->save($webpFilePath, 90, 'webp', ['quality' => 90]);

    return [
        'path' => $webpFilePath,
        'filename' => $webpFilename,
    ];
}



function getAttachments($attchments)
{
    $files = [];
    if (count($attchments) > 0) {
        foreach ($attchments as $attchment) {
            if (getFileExistsCheck($attchment)) {
                array_push($files, $attchment->getFullUrl());
            }
        }
    }

    return $files;
}
function getAttachmentArray($attchments)
{
    $files = [];
    if (count($attchments) > 0) {
        foreach ($attchments as $attchment) {
            if (getFileExistsCheck($attchment)) {
                $file = [
                    'id' => $attchment->id,
                    'url' => $attchment->getFullUrl()
                ];
                array_push($files, $file);
            }
        }
    }

    return $files;
}
function getMediaFileExit($model, $collection = 'profile_image')
{
    if ($model == null) {
        return asset('images/user/user.png');;
    }

    $media = $model->getFirstMedia($collection);

    return getFileExistsCheck($media);
}

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->is($route);

    if ($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

function saveBookingActivity($data)
{
    $admin = \App\Models\AppSetting::first();
    date_default_timezone_set($admin->time_zone ?? 'UTC');
    $data['datetime'] = date('Y-m-d H:i:s');
    $role = auth()->user()->user_type;
    switch ($data['activity_type']) {
        case "add_booking":
            $data['activity_message'] = __('messages.booking_added');
            $data['activity_type'] = __('messages.add_booking');
            $activity_data = [
                'service_id' => $data['booking']->service_id,
                'service_name' => isset($data['booking']->service) ? $data['booking']->service->name : '',
                'customer_id' => $data['booking']->customer_id,
                'customer_name' => isset($data['booking']->customer) ? $data['booking']->customer->display_name : '',
                'provider_id' => $data['booking']->provider_id,
                'provider_name' => isset($data['booking']->provider) ? $data['booking']->provider->display_name : '',
            ];
            $sendTo = ['admin', 'provider'];
            break;
        case "assigned_booking":
            $assigned_handyman = handymanNames($data['booking']->handymanAdded);
            $data['activity_message'] = __('messages.booking_assigned', ['name' => $assigned_handyman]);
            $data['activity_type'] = __('messages.assigned_booking');

            $activity_data = [
                'handyman_id' => $data['booking']->handymanAdded->pluck('handyman_id'),
                'handyman_name' => $data['booking']->handymanAdded,
            ];
            $sendTo = ['handyman'];
            break;

        case "transfer_booking":
            $assigned_handyman = handymanNames($data['booking']->handymanAdded);

            $data['activity_type'] = __('messages.transfer_booking');
            $data['activity_message'] = __('messages.booking_transfer', ['name' => $assigned_handyman]);
            $activity_data = [
                'handyman_id' => $data['booking']->handymanAdded->pluck('handyman_id'),
                'handyman_name' => $data['booking']->handymanAdded,
            ];
            $sendTo = ['handyman'];
            break;

        case "update_booking_status":

            $status = \App\Models\BookingStatus::bookingStatus($data['booking']->status);
            $old_status = \App\Models\BookingStatus::bookingStatus($data['booking']->old_status);
            $data['activity_type'] = __('messages.update_booking_status');
            $data['activity_message'] = __('messages.booking_status_update', ['from' => $old_status, 'to' => $status]);
            $activity_data = [
                'reason' => $data['booking']->reason,
                'status' => $data['booking']->status,
                'status_label' => $status,
                'old_status' => $data['booking']->old_status,
                'old_status_label' => $old_status,
            ];

            $sendTo = removeArrayValue(['admin', 'provider', 'handyman', 'user'], $role);
            break;
        case "cancel_booking":
            $status = \App\Models\BookingStatus::bookingStatus($data['booking']->status);
            $old_status = \App\Models\BookingStatus::bookingStatus($data['booking']->old_status);
            $data['activity_type'] = __('messages.cancel_booking');

            $data['activity_message'] = __('messages.cancel_booking');
            $activity_data = [
                'reason' => $data['booking']->reason,
                'status' => $data['booking']->status,
                'status_label' => \App\Models\BookingStatus::bookingStatus($data['booking']->status),
            ];
            $sendTo = removeArrayValue(['admin', 'provider', 'handyman', 'user'], $role);
            break;
        case "payment_message_status":
            $data['activity_type'] = __('messages.payment_message_status');

            $data['activity_message'] = __('messages.payment_message', ['status' => $data['payment_status']]);

            $activity_data = [
                'activity_type' => $data['activity_type'],
                'payment_status' => $data['payment_status'],
                'booking_id' => $data['booking_id'],
            ];
            $sendTo = ['user'];
            break;

        default:
            $activity_data = [];
            break;
    }
    $data['activity_data'] = json_encode($activity_data);
    \App\Models\BookingActivity::create($data);
    $notification_data = [
        'id'   => $data['booking']->id,
        'type' => $data['activity_type'],
        'subject' => $data['activity_type'],
        'message' => $data['activity_message'],
        "ios_badgeType" => "Increase",
        "ios_badgeCount" => 1
    ];


    foreach ($sendTo as $to) {

        switch ($to) {
            case 'admin':
                $user = \App\Models\User::getUserByKeyValue('user_type', 'admin');
                break;
            case 'provider':
                $user = \App\Models\User::getUserByKeyValue('id', $data['booking']->provider_id);
                break;
            case 'handyman':
                $handymans = $data['booking']->handymanAdded->pluck('handyman_id');
                foreach ($handymans as $id) {
                    $user = \App\Models\User::getUserByKeyValue('id', $id);
                    sendNotification('provider', $user, $notification_data);
                }
                break;
            case 'user':
                $user = \App\Models\User::getUserByKeyValue('id', $data['booking']->customer_id);
                break;
        }
        if ($to != 'handyman') {
            sendNotification($to, $user, $notification_data);
        }
    }
}

function settingSession($type = 'get')
{
    if (\Session::get('setting_data') == '') {
        $type = 'set';
    }
    switch ($type) {
        case "set":
            $settings = \App\Models\AppSetting::first();
            \Session::put('setting_data', $settings);
            break;
        default:
            break;
    }
    return \Session::get('setting_data');
}

function envChanges($type, $value)
{
    $path = base_path('.env');

    $checkType = $type . '="';
    if (strpos($value, ' ') || strpos(file_get_contents($path), $checkType) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)) {
        $value = '"' . $value . '"';
    }

    $value = str_replace('\\', '\\\\', $value);

    if (file_exists($path)) {
        $typeValue = env($type);

        if (strpos(env($type), ' ') || strpos(file_get_contents($path), $checkType)) {
            $typeValue = '"' . env($type) . '"';
        }

        file_put_contents($path, str_replace(
            $type . '=' . $typeValue,
            $type . '=' . $value,
            file_get_contents($path)
        ));

        $onesignal = collect(config('constant.ONESIGNAL'))->keys();

        $checkArray = \Arr::collapse([$onesignal, ['DEFAULT_LANGUAGE']]);


        if (in_array($type, $checkArray)) {
            if (env($type) === null) {
                file_put_contents($path, "\n" . $type . '=' . $value, FILE_APPEND);
            }
        }
    }
}

function getPriceFormat($price)
{
    if (gettype($price) == 'string') {
        return $price;
    }
    if ($price == null) {
        return 0;
    }
    $currency_symbol = \App\Models\Setting::where('type', 'CURRENCY')->where('key', 'CURRENCY_COUNTRY_ID')->with('country')->first();
    $symbol = '$';
    if (!empty($currency_symbol)) {
        $symbol = $currency_symbol->country->symbol;
    }
    $currency_position = \App\Models\Setting::where('type', 'CURRENCY')->where('key', 'CURRENCY_POSITION')->first();
    $position = 'left';
    if (!empty($currency_position)) {
        $position = $currency_position->value;
    }

    if ($position == 'left') {
        $price = $symbol . "" . number_format((float)$price, 2, '.', '');
    } else {
        $price = number_format((float)$price, 2, '.', '') . "" . $symbol;
    }

    return $price;
}
function payment_status()
{

    return [
        'pending' => __('messages.pending'),
        'paid' => __('messages.paid'),
        'failed' => __('messages.failed'),
        'refunded' => __('messages.refunded')
    ];
}

function formatOffset($offset)
{
    $hours = $offset / 3600;
    $remainder = $offset % 3600;
    $sign = $hours > 0 ? '+' : '-';
    $hour = (int) abs($hours);
    $minutes = (int) abs($remainder / 60);

    if ($hour == 0 and $minutes == 0) {
        $sign = ' ';
    }
    return 'GMT' . $sign . str_pad($hour, 2, '0', STR_PAD_LEFT)
        . ':' . str_pad($minutes, 2, '0');
}

function timeZoneList()
{
    $list = \DateTimeZone::listAbbreviations();
    $idents = \DateTimeZone::listIdentifiers();

    $data = $offset = $added = array();
    foreach ($list as $abbr => $info) {
        foreach ($info as $zone) {
            if (!empty($zone['timezone_id']) and !in_array($zone['timezone_id'], $added) and in_array($zone['timezone_id'], $idents)) {

                $z = new \DateTimeZone($zone['timezone_id']);
                $c = new \DateTime(null, $z);
                $zone['time'] = $c->format('H:i a');
                $offset[] = $zone['offset'] = $z->getOffset($c);
                $data[] = $zone;
                $added[] = $zone['timezone_id'];
            }
        }
    }

    array_multisort($offset, SORT_ASC, $data);
    $options = array();
    foreach ($data as $key => $row) {

        $options[$row['timezone_id']] = $row['time'] . ' - ' . formatOffset($row['offset'])  . ' ' . $row['timezone_id'];
    }
    $options['America/Sao_Paulo'] = '3:00 pm -  GMT-03:00 America/Sao_Paulo';
    return $options;
}

function stringLong($str = '', $type = 'title', $length = 0) //Add … if string is too long
{
    if ($length != 0) {
        return strlen($str) > $length ? substr($str, 0, $length) . "..." : $str;
    }
    if ($type == 'desc') {
        return strlen($str) > 150 ? substr($str, 0, 150) . "..." : $str;
    } elseif ($type == 'title') {
        return strlen($str) > 15 ? substr($str, 0, 25) . "..." : $str;
    } else {
        return $str;
    }
}
function dateAgoFormate($date, $type2 = '')
{
    if ($date == null || $date == '0000-00-00 00:00:00') {
        return '-';
    }

    $diff_time1 = \Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
    $datetime = new \DateTime($date);
    $la_time = new \DateTimeZone(\Auth::check() ? \Auth::user()->time_zone ?? 'UTC' : 'UTC');
    $datetime->setTimezone($la_time);
    $diff_date = $datetime->format('Y-m-d H:i:s');

    $diff_time = \Carbon\Carbon::parse($diff_date)->isoFormat('LLL');

    if ($type2 != '') {
        return $diff_time;
    }

    return $diff_time1 . ' on ' . $diff_time;
}

function timeAgoFormate($date)
{
    if ($date == null) {
        return '-';
    }

    // date_default_timezone_set('UTC');

    $diff_time = \Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();

    return $diff_time;
}

function duration($start = '', $end = '', $type = '')
{
    $start = \Carbon\Carbon::parse($start);
    $end = \Carbon\Carbon::parse($end);

    if ($type) {
        $diff_in_minutes = $start->diffInMinutes($end);
        return $diff_in_minutes;
    } else {
        $diff = $start->diff($end);
        return $diff->format('%H:%I');
    }
}

function removeArrayValue($array, $find)
{
    foreach (array_keys($array, $find) as $key) {
        unset($array[$key]);
    }

    return array_values($array);
}

function handymanNames($collection)
{
    return $collection->mapWithKeys(function ($item) {
        return [$item->handyman_id => optional($item->handyman)->display_name];
    })->values()->implode(',');
}

function degreeArray()
{
    $degree = [
        ['name' => 'Below 10th', 'id' => '0', 'slug' => 'below-10th-jobs'],
        ['name' => '10th/12th', 'id' => '1', 'slug' => '10th-12th-jobs'],
        ['name' => 'ITI/Diploma', 'id' => '2', 'slug' => 'iti-dipoloma-jobs'],
        ['name' => 'Degree', 'id' => '3', 'slug' => 'degree-jobs']
    ];
    return $degree;
}


function languagesArray($ids = [])
{
    $language = [
        ['title' => 'Abkhaz', 'id' => 'ab'],
        ['title' => 'Afar', 'id' => 'aa'],
        ['title' => 'Afrikaans', 'id' => 'af'],
        ['title' => 'Akan', 'id' => 'ak'],
        ['title' => 'Albanian', 'id' => 'sq'],
        ['title' => 'Amharic', 'id' => 'am'],
        ['title' => 'Arabic', 'id' => 'ar'],
        ['title' => 'Aragonese', 'id' => 'an'],
        ['title' => 'Armenian', 'id' => 'hy'],
        ['title' => 'Assamese', 'id' => 'as'],
        ['title' => 'Avaric', 'id' => 'av'],
        ['title' => 'Avestan', 'id' => 'ae'],
        ['title' => 'Aymara', 'id' => 'ay'],
        ['title' => 'Azerbaijani', 'id' => 'az'],
        ['title' => 'Bambara', 'id' => 'bm'],
        ['title' => 'Bashkir', 'id' => 'ba'],
        ['title' => 'Basque', 'id' => 'eu'],
        ['title' => 'Belarusian', 'id' => 'be'],
        ['title' => 'Bengali', 'id' => 'bn'],
        ['title' => 'Bihari', 'id' => 'bh'],
        ['title' => 'Bislama', 'id' => 'bi'],
        ['title' => 'Bosnian', 'id' => 'bs'],
        ['title' => 'Breton', 'id' => 'br'],
        ['title' => 'Bulgarian', 'id' => 'bg'],
        ['title' => 'Burmese', 'id' => 'my'],
        ['title' => 'Catalan; Valencian', 'id' => 'ca'],
        ['title' => 'Chamorro', 'id' => 'ch'],
        ['title' => 'Chechen', 'id' => 'ce'],
        ['title' => 'Chichewa; Chewa; Nyanja', 'id' => 'ny'],
        ['title' => 'Chinese', 'id' => 'zh'],
        ['title' => 'Chuvash', 'id' => 'cv'],
        ['title' => 'Cornish', 'id' => 'kw'],
        ['title' => 'Corsican', 'id' => 'co'],
        ['title' => 'Cree', 'id' => 'cr'],
        ['title' => 'Croatian', 'id' => 'hr'],
        ['title' => 'Czech', 'id' => 'cs'],
        ['title' => 'Danish', 'id' => 'da'],
        ['title' => 'Divehi; Dhivehi; Maldivian;', 'id' => 'dv'],
        ['title' => 'Dutch', 'id' => 'nl'],
        ['title' => 'English', 'id' => 'en'],
        ['title' => 'Esperanto', 'id' => 'eo'],
        ['title' => 'Estonian', 'id' => 'et'],
        ['title' => 'Ewe', 'id' => 'ee'],
        ['title' => 'Faroese', 'id' => 'fo'],
        ['title' => 'Fijian', 'id' => 'fj'],
        ['title' => 'Finnish', 'id' => 'fi'],
        ['title' => 'French', 'id' => 'fr'],
        ['title' => 'Fula; Fulah; Pulaar; Pular', 'id' => 'ff'],
        ['title' => 'Galician', 'id' => 'gl'],
        ['title' => 'Georgian', 'id' => 'ka'],
        ['title' => 'German', 'id' => 'de'],
        ['title' => 'Greek, Modern', 'id' => 'el'],
        ['title' => 'Guaraní', 'id' => 'gn'],
        ['title' => 'Gujarati', 'id' => 'gu'],
        ['title' => 'Haitian; Haitian Creole', 'id' => 'ht'],
        ['title' => 'Hausa', 'id' => 'ha'],
        ['title' => 'Hebrew (modern)', 'id' => 'he'],
        ['title' => 'Herero', 'id' => 'hz'],
        ['title' => 'Hindi', 'id' => 'hi'],
        ['title' => 'Hiri Motu', 'id' => 'ho'],
        ['title' => 'Hungarian', 'id' => 'hu'],
        ['title' => 'Interlingua', 'id' => 'ia'],
        ['title' => 'Indonesian', 'id' => 'id'],
        ['title' => 'Interlingue', 'id' => 'ie'],
        ['title' => 'Irish', 'id' => 'ga'],
        ['title' => 'Igbo', 'id' => 'ig'],
        ['title' => 'Inupiaq', 'id' => 'ik'],
        ['title' => 'Ido', 'id' => 'io'],
        ['title' => 'Icelandic', 'id' => 'is'],
        ['title' => 'Italian', 'id' => 'it'],
        ['title' => 'Inuktitut', 'id' => 'iu'],
        ['title' => 'Japanese', 'id' => 'ja'],
        ['title' => 'Javanese', 'id' => 'jv'],
        ['title' => 'Kalaallisut, Greenlandic', 'id' => 'kl'],
        ['title' => 'Kannada', 'id' => 'kn'],
        ['title' => 'Kanuri', 'id' => 'kr'],
        ['title' => 'Kashmiri', 'id' => 'ks'],
        ['title' => 'Kazakh', 'id' => 'kk'],
        ['title' => 'Khmer', 'id' => 'km'],
        ['title' => 'Kikuyu, Gikuyu', 'id' => 'ki'],
        ['title' => 'Kinyarwanda', 'id' => 'rw'],
        ['title' => 'Kirghiz, Kyrgyz', 'id' => 'ky'],
        ['title' => 'Komi', 'id' => 'kv'],
        ['title' => 'Kongo', 'id' => 'kg'],
        ['title' => 'Korean', 'id' => 'ko'],
        ['title' => 'Kurdish', 'id' => 'ku'],
        ['title' => 'Kwanyama, Kuanyama', 'id' => 'kj'],
        ['title' => 'Latin', 'id' => 'la'],
        ['title' => 'Luxembourgish, Letzeburgesch', 'id' => 'lb'],
        ['title' => 'Luganda', 'id' => 'lg'],
        ['title' => 'Limburgish, Limburgan, Limburger', 'id' => 'li'],
        ['title' => 'Lingala', 'id' => 'ln'],
        ['title' => 'Lao', 'id' => 'lo'],
        ['title' => 'Lithuanian', 'id' => 'lt'],
        ['title' => 'Luba-Katanga', 'id' => 'lu'],
        ['title' => 'Latvian', 'id' => 'lv'],
        ['title' => 'Manx', 'id' => 'gv'],
        ['title' => 'Macedonian', 'id' => 'mk'],
        ['title' => 'Malagasy', 'id' => 'mg'],
        ['title' => 'Malay', 'id' => 'ms'],
        ['title' => 'Malayalam', 'id' => 'ml'],
        ['title' => 'Maltese', 'id' => 'mt'],
        ['title' => 'Māori', 'id' => 'mi'],
        ['title' => 'Marathi (Marāṭhī)', 'id' => 'mr'],
        ['title' => 'Marshallese', 'id' => 'mh'],
        ['title' => 'Mongolian', 'id' => 'mn'],
        ['title' => 'Nauru', 'id' => 'na'],
        ['title' => 'Navajo, Navaho', 'id' => 'nv'],
        ['title' => 'Norwegian Bokmål', 'id' => 'nb'],
        ['title' => 'North Ndebele', 'id' => 'nd'],
        ['title' => 'Nepali', 'id' => 'ne'],
        ['title' => 'Ndonga', 'id' => 'ng'],
        ['title' => 'Norwegian Nynorsk', 'id' => 'nn'],
        ['title' => 'Norwegian', 'id' => 'no'],
        ['title' => 'Nuosu', 'id' => 'ii'],
        ['title' => 'South Ndebele', 'id' => 'nr'],
        ['title' => 'Occitan', 'id' => 'oc'],
        ['title' => 'Ojibwe, Ojibwa', 'id' => 'oj'],
        ['title' => 'Oromo', 'id' => 'om'],
        ['title' => 'Oriya', 'id' => 'or'],
        ['title' => 'Ossetian, Ossetic', 'id' => 'os'],
        ['title' => 'Panjabi, Punjabi', 'id' => 'pa'],
        ['title' => 'Pāli', 'id' => 'pi'],
        ['title' => 'Persian', 'id' => 'fa'],
        ['title' => 'Polish', 'id' => 'pl'],
        ['title' => 'Pashto, Pushto', 'id' => 'ps'],
        ['title' => 'Portuguese', 'id' => 'pt'],
        ['title' => 'Quechua', 'id' => 'qu'],
        ['title' => 'Romansh', 'id' => 'rm'],
        ['title' => 'Kirundi', 'id' => 'rn'],
        ['title' => 'Romanian, Moldavian, Moldovan', 'id' => 'ro'],
        ['title' => 'Russian', 'id' => 'ru'],
        ['title' => 'Sanskrit (Saṁskṛta)', 'id' => 'sa'],
        ['title' => 'Sardinian', 'id' => 'sc'],
        ['title' => 'Sindhi', 'id' => 'sd'],
        ['title' => 'Northern Sami', 'id' => 'se'],
        ['title' => 'Samoan', 'id' => 'sm'],
        ['title' => 'Sango', 'id' => 'sg'],
        ['title' => 'Serbian', 'id' => 'sr'],
        ['title' => 'Scottish Gaelic; Gaelic', 'id' => 'gd'],
        ['title' => 'Shona', 'id' => 'sn'],
        ['title' => 'Sinhala, Sinhalese', 'id' => 'si'],
        ['title' => 'Slovak', 'id' => 'sk'],
        ['title' => 'Slovene', 'id' => 'sl'],
        ['title' => 'Somali', 'id' => 'so'],
        ['title' => 'Southern Sotho', 'id' => 'st'],
        ['title' => 'Spanish; Castilian', 'id' => 'es'],
        ['title' => 'Sundanese', 'id' => 'su'],
        ['title' => 'Swahili', 'id' => 'sw'],
        ['title' => 'Swati', 'id' => 'ss'],
        ['title' => 'Swedish', 'id' => 'sv'],
        ['title' => 'Tamil', 'id' => 'ta'],
        ['title' => 'Telugu', 'id' => 'te'],
        ['title' => 'Tajik', 'id' => 'tg'],
        ['title' => 'Thai', 'id' => 'th'],
        ['title' => 'Tigrinya', 'id' => 'ti'],
        ['title' => 'Tibetan Standard, Tibetan, Central', 'id' => 'bo'],
        ['title' => 'Turkmen', 'id' => 'tk'],
        ['title' => 'Tagalog', 'id' => 'tl'],
        ['title' => 'Tswana', 'id' => 'tn'],
        ['title' => 'Tonga (Tonga Islands)', 'id' => 'to'],
        ['title' => 'Turkish', 'id' => 'tr'],
        ['title' => 'Tsonga', 'id' => 'ts'],
        ['title' => 'Tatar', 'id' => 'tt'],
        ['title' => 'Twi', 'id' => 'tw'],
        ['title' => 'Tahitian', 'id' => 'ty'],
        ['title' => 'Uighur, Uyghur', 'id' => 'ug'],
        ['title' => 'Ukrainian', 'id' => 'uk'],
        ['title' => 'Urdu', 'id' => 'ur'],
        ['title' => 'Uzbek', 'id' => 'uz'],
        ['title' => 'Venda', 'id' => 've'],
        ['title' => 'Vietnamese', 'id' => 'vi'],
        ['title' => 'Volapük', 'id' => 'vo'],
        ['title' => 'Walloon', 'id' => 'wa'],
        ['title' => 'Welsh', 'id' => 'cy'],
        ['title' => 'Wolof', 'id' => 'wo'],
        ['title' => 'Western Frisian', 'id' => 'fy'],
        ['title' => 'Xhosa', 'id' => 'xh'],
        ['title' => 'Yiddish', 'id' => 'yi'],
        ['title' => 'Yoruba', 'id' => 'yo'],
        ['title' => 'Zhuang, Chuang', 'id' => 'za']
    ];
    if (!empty($ids)) {
        $language = collect($language)->whereIn('id', $ids)->values();
    }
    return $language;
}
function replaceJsonString($replace_from, $replace_to, $input)
{
    $result = "";

    for ($i = 0; $i < strlen($input); $i++) {
        $result .= ($input[$i] == $replace_from) ? $replace_to : $input[$i];
    }

    return $result;
}
function flattenToMultiDimensional(array $array, $delimiter = '.')
{
    $result = [];
    foreach ($array as $notations => $value) {
        // extract keys
        $keys = explode($delimiter, $notations);
        // reverse keys for assignments
        $keys = array_reverse($keys);

        // set initial value
        $lastVal = $value;
        foreach ($keys as $key) {
            // wrap value with key over each iteration
            $lastVal = [
                $key => $lastVal
            ];
        }

        // merge result
        $result = array_merge_recursive($result, $lastVal);
    }

    return $result;
}
function createLangFile($lang = '')
{
    $langDir = resource_path() . '/lang/';
    $enDir = $langDir . 'en';
    $currentLang = $langDir . $lang;
    if (!File::exists($currentLang)) {
        File::makeDirectory($currentLang);
        File::copyDirectory($enDir, $currentLang);
    }
}

function convertToHoursMins($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return sprintf($format, 0, 0);
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function getSettingKeyValue($type = "", $key = "")
{
    $setting_data = \App\Models\Setting::where('type', $type)->where('key', $key)->first();
    if ($setting_data != null) {
        return $setting_data->value;
    } else {


        switch ($key) {
            case 'DISTANCE_TYPE':
                return 'km';
                break;
            case 'DISTANCE_RADIOUS':
                return 50;
                break;
            default:
                break;
        }
    }
}

function countUnitvalue($unit)
{
    switch ($unit) {
        case 'mile':
            return 3956;
            break;
        default:
            return 6371;
            break;
    }
}




function imageExtention($media)
{
    $extention = null;
    if ($media != null) {
        $path_info = pathinfo($media);
        $extention = $path_info['extension'];
    }
    return $extention;
}

function verify_provider_document($provider_id)
{
    $documents = \App\Models\Documents::where('is_required', 1)->where('status', 1)->withCount([
        'providerDocument',
        'providerDocument as is_verified_document' => function ($query) use ($provider_id) {
            $query->where('is_verified', 1)->where('provider_id', $provider_id);
        }
    ])
        ->get();

    $is_verified = $documents->where('is_verified_document', 1);

    if (count($documents) == count($is_verified)) {
        return true;
    } else {
        return false;
    }
}
function format_number_field($value)
{

    if ($value !== 0) {
        return getPriceFormat($value);
    }

    return 0;
}
function format_commission($value)
{
    // if($value == 0){
    //     return '';
    // }
    if ($value != null) {
        $commission_value = optional($value->providertype)->commission;
        $commission_type = optional($value->providertype)->type;

        $commission = getPriceFormat($commission_value);
        if ($commission_type === 'percent') {
            $commission = $commission_value . '%';
        }

        return $commission;
    }
}

function calculate_commission($total_amount = 0, $provider_commission = 0, $commission_type = 'percent', $type = '', $totalEarning = 0, $count = 0)
{
    if ($total_amount === 0) {
        return [
            'value' => '-',
            'number_format' => 0
        ];
    }
    switch ($type) {
        case 'provider':
            $earning =   ($total_amount) - ($provider_commission * $count);
            if ($commission_type === 'percent') {
                $earning =  ($total_amount) * $provider_commission / 100;
            }
            $final_amount = $earning - $totalEarning;
            break;
        default:
            $earning =  $provider_commission * $count;
            if ($commission_type === 'percent') {
                $earning = ($total_amount) * (100 - $provider_commission) / 100;
            }
            $final_amount = $earning;
            break;
    }
    return [
        'value' => getPriceFormat($final_amount),
        'number_format' => $final_amount
    ];
}

function get_provider_commission($bookings)
{
    $all_booking_total = $bookings->map(function ($booking) {
        return $booking->total_amount;
    })->toArray();

    $all_booking_tax = $bookings->map(function ($booking) {
        return $booking->getTaxesValue();
    })->toArray();

    $total = array_reduce($all_booking_total, function ($value1, $value2) {
        return $value1 + $value2;
    }, 0);

    $tax = array_reduce($all_booking_tax, function ($tax1, $tax2) {
        return $tax1 + $tax2;
    }, 0);

    $total_amount = $total;

    return [
        'total_amount' => $total_amount,
        'tax' => $tax,
        'total' => $total,
        'all_booking_tax' => $all_booking_tax,
        'all_booking_total' => $all_booking_total,
    ];
}
function get_handyman_provider_commission($handyman_id)
{
    $hadnymantype_id = !empty($handyman_id) ? $handyman_id : 1;
    $get_commission = \App\Models\HandymanType::withTrashed()->where('id', $hadnymantype_id)->first();
    if ($get_commission) {
        $commission_value = $get_commission->commission;
        $commission_type = $get_commission->type;

        $commission = getPriceFormat($commission_value);
        if ($commission_type === 'percent') {
            $commission = $commission_value . '%';
        }

        return $commission;
    }
    return '-';
}
function adminEarning()
{
    $revenuedata = \App\Models\Payment::selectRaw('sum(total_amount) as total , booking_id, DATE_FORMAT(datetime , "%m") as month')
        ->whereYear('datetime', date('Y'))
        ->where('payment_status', 'paid')
        ->groupBy('month');
    $revenuedata = $revenuedata->get()->toArray();
    foreach ($revenuedata as $key => $value) {
        $total_amount = $value['total'];
        $booking  =  \App\Models\Booking::where('id', $value['booking_id'])->first();
        if (!empty($booking)) {
            $provider = App\Models\User::where('id', $booking->provider_id)->first();
            $provider_commission = optional($provider->providertype)->commission;
            $provider_type = optional($provider->providertype)->type;
            $earning =   ($total_amount) - ($provider_commission);
            if ($provider_type === 'percent') {
                $earning =  ($total_amount) * $provider_commission / 100;
            }
            $revenuedata[$key]['providerEarning'] = $earning;
            $revenuedata[$key]['afterAmount'] = $total_amount - $earning;
        } else {
            $revenuedata[$key]['providerEarning'] = 0;
            $revenuedata[$key]['afterAmount'] = 0;
        }
    }

    $data['revenueData']    =    [];
    for ($i = 1; $i <= 12; $i++) {
        $revenueData = 0;
        foreach ($revenuedata as $revenue) {
            if ((int)$revenue['month'] == $i) {
                $data['revenueData'][] = (int)$revenue['afterAmount'];
                $revenueData++;
            }
        }
        if ($revenueData == 0) {
            $data['revenueData'][] = 0;
        }
    }
    return $data['revenueData'];
}
function savePayoutActivity($data)
{
    switch ($data['type']) {
        case "provider_payout":
            $data['activity_message'] = __('messages.payout_paid', ['type' => 'Admin', 'amount' => $data['amount']]);
            $activity_data = [
                'user_id' => $data['user_id'],
                'amount' => $data['amount'],
            ];
            $sendTo = ['provider'];
            break;
        case "handyman_payout":
            $data['activity_message'] = __('messages.payout_paid', ['type' => 'Provider', 'amount' => $data['amount']]);
            $activity_data = [
                'user_id' => $data['user_id'],
                'amount' => $data['amount'],
            ];
            $sendTo = ['handyman'];
            break;

        default:
            $activity_data = [];
            break;
    }

    $notification_data = [
        'id'   => $data['user_id'],
        'type' => $data['activity_type'],
        'subject' => $data['activity_type'],
        'message' => $data['activity_message'],
    ];
    foreach ($sendTo as $to) {
        switch ($to) {
            case 'provider':
                $user = \App\Models\User::getUserByKeyValue('id', $data['user_id']);
                break;
            case 'handyman':
                $user = \App\Models\User::getUserByKeyValue('id', $data['user_id']);
                break;
        }
        $user->notify(new App\Notifications\CommonNotification($data['activity_type'], $notification_data));
        $user->notify(new \App\Notifications\PayoutNotification($notification_data));
    }
}
function getTimeZone()
{
    $timezone = \App\Models\AppSetting::first();
    return $timezone->time_zone ?? 'UTC';
}
function get_plan_expiration_date($plan_start_date = '', $plan_type = '', $left_days = 0, $plan_duration = 1)
{
    $start_at = new \Carbon\Carbon($plan_start_date);
    $end_date = '';

    if ($plan_type === 'weekly') {
        $getdays = App\Models\Plans::where('identifier', 'free')->first();
        $getdays = $getdays->trial_period;
        $days = $left_days + $getdays;
        $end_date =  $start_at->addDays($days);
    }
    if ($plan_type === 'monthly') {
        $end_date =  $start_at->addMonths($plan_duration)->addDays($left_days);
    }
    if ($plan_type === 'yearly') {
        $end_date =  $start_at->addYears($plan_duration)->addDays($left_days);
    }
    return $end_date->format('Y-m-d H:i:s');
}
function get_user_active_plan($user_id)
{
    $get_provider_plan  =  \App\Models\ProviderSubscription::where('user_id', $user_id)->where('status', config('constant.SUBSCRIPTION_STATUS.ACTIVE'))->first();
    $activeplan = null;
    if (!empty($get_provider_plan)) {
        $activeplan = new App\Http\Resources\API\ProviderSubscribeResource($get_provider_plan);
    }
    return $activeplan;
}
function is_subscribed_user($user_id)
{
    $user_subscribed = \App\Models\ProviderSubscription::where('user_id', $user_id)->where('status', config('constant.SUBSCRIPTION_STATUS.ACTIVE'))->first();
    $value = 0;
    if ($user_subscribed) {
        $value = 1;
    }
    return $value;
}
function check_days_left_plan($old_plan, $new_plan)
{
    $previous_plan_start = $old_plan->start_at;
    $previous_plan_end = new \Carbon\Carbon($old_plan->end_at);
    $new_plan_start = new \Carbon\Carbon(date('Y-m-d H:i:s'));
    $left_days = $previous_plan_end->diffInDays($new_plan_start);
    return $left_days;
}
function user_last_plan($user_id)
{
    $user_subscribed = \App\Models\ProviderSubscription::where('user_id', $user_id)
        ->where('status', config('constant.SUBSCRIPTION_STATUS.INACTIVE'))->orderBy('id', 'desc')->first();
    $inactivePlan = null;
    if (!empty($user_subscribed)) {
        $inactivePlan = new App\Http\Resources\API\ProviderSubscribeResource($user_subscribed);
    }
    return $inactivePlan;
}
function is_any_plan_active($user_id)
{
    $user_subscribed = \App\Models\ProviderSubscription::where('user_id', $user_id)->where('status', config('constant.SUBSCRIPTION_STATUS.ACTIVE'))->first();
    $value = 0;
    if ($user_subscribed) {
        $value = 1;
    }
    return $value;
}
function default_earning_type()
{
    $gettype = \App\Models\AppSetting::first();
    $earningtype = $gettype->earning_type ? $gettype->earning_type : 'commission';
    return $earningtype;
}
function saveWalletHistory($data)
{
    $admin = \App\Models\AppSetting::first();
    date_default_timezone_set($admin->time_zone ?? 'UTC');
    $data['datetime'] = date('Y-m-d H:i:s');
    $data['user_id'] =  $data['wallet']->user_id;
    $role = auth()->user()->user_type;
    switch ($data['activity_type']) {
        case "add_wallet":
            $data['activity_message'] = __('messages.wallet_added');
            $activity_data = [
                'title' => $data['wallet']->title,
                'user_id' => $data['wallet']->user_id,
                'provider_name' => isset($data['wallet']->provider) ? $data['wallet']->provider->display_name : '',
                'amount' => $data['wallet']->amount,
            ];
            break;

        case "update_wallet":
            $data['activity_message'] = __('messages.update_wallet');
            $activity_data = [
                'title' => $data['wallet']->title,
                'user_id' => $data['wallet']->user_id,
                'provider_name' => isset($data['wallet']->provider) ? $data['wallet']->provider->display_name : '',
                'amount' => $data['wallet']->amount,
            ];
            break;

        case "wallet_payout_transfer":
            $data['activity_message'] = __('messages.wallet_amount', ['value' => getPriceFormat($data['wallet']->amount)]);
            $activity_data = [
                'title' => $data['wallet']->title,
                'user_id' => $data['wallet']->user_id,
                'provider_name' => isset($data['wallet']->provider) ? $data['wallet']->provider->display_name : '',
                'amount' => $data['wallet']->amount,
            ];
            break;
        default:
            $activity_data = [];
            break;
    }
    $data['activity_data'] = json_encode($activity_data);

    \App\Models\WalletHistory::create($data);

    $notification_data = [
        'id'   => $data['wallet']->id,
        'type' => $data['activity_type'],
        'subject' => $data['activity_type'],
        'message' => $data['activity_message'],
        'notification_type' => 'wallet',
    ];
    $user = \App\Models\User::getUserByKeyValue('id', $data['wallet']->user_id);
    $user->notify(new App\Notifications\CommonNotification($data['activity_type'], $notification_data));
    $user->notify(new \App\Notifications\WalletNotification($notification_data));
}
function get_provider_plan_limit($provider_id, $type)
{
    $limit_array = array();

    if (is_any_plan_active($provider_id) == 1) {
        $exceed = '';
        $get_current_plan = get_user_active_plan($provider_id);
        if ($get_current_plan->plan_type === 'limited') {
            $get_plan_limit = json_decode($get_current_plan->plan_limitation, true);
            $plan_start_date =  date('Y-m-d', strtotime($get_current_plan->start_at));

            if ($type === 'service') {
                $limit_array = $get_plan_limit['service'];
                $provider_service_count = \App\Models\Service::where('provider_id', $provider_id)->whereDate('created_at', '>=', $plan_start_date)->count();
                if ($limit_array['is_checked'] == 'on' && $limit_array['limit'] != null) {
                    if ($provider_service_count >= $limit_array['limit']) {
                        $exceed = 1; // 1 for exceed limit;
                    }
                } elseif ($limit_array['is_checked'] === 'on' && $limit_array['limit'] == null) {
                    $exceed = 0;
                }
            }
            if ($type === 'featured_service') {
                $limit_array = $get_plan_limit['featured_service'];
                $provider_featured_service_count = \App\Models\Service::where('provider_id', $provider_id)->where('is_featured', 1)->whereDate('created_at', '>=', $plan_start_date)->count();
                if ($limit_array['is_checked'] == 'on' && $limit_array['limit'] != null) {
                    if ($provider_featured_service_count >= $limit_array['limit']) {
                        $exceed = 1; // 1 for exceed limit;
                    }
                } elseif ($limit_array['is_checked'] === 'on' && $limit_array['limit'] == null) {
                    $exceed = 0;
                }
            }
            if ($type === 'handyman') {
                $limit_array = $get_plan_limit['handyman'];
                $handyman_count = \App\Models\User::where('provider_id', $provider_id)->whereDate('created_at', '>=', $plan_start_date)->count();
                if ($limit_array['is_checked'] == 'on' && $limit_array['limit'] != null) {
                    if ($handyman_count >= $limit_array['limit']) {
                        $exceed = 1; // 1 for exceed limit;
                    }
                } elseif ($limit_array['is_checked'] === 'on' && $limit_array['limit'] == null) {
                    $exceed = 0;
                }
            }
        } else {
            return;
        }
    } else {
        return;
    }
    return $exceed;
}
function sendNotification($type, $user, $data)
{


    $app_id = ENV('ONESIGNAL_API_KEY');
    $rest_api_key = ENV('ONESIGNAL_REST_API_KEY');
    if ($type === 'user') {
        $app_id = ENV('ONESIGNAL_API_KEY');
        $rest_api_key = ENV('ONESIGNAL_REST_API_KEY');
    }
    if ($type === 'provider') {
        $app_id = ENV('ONESIGNAL_APP_ID_PROVIDER');
        $rest_api_key = ENV('ONESIGNAL_REST_API_KEY_PROVIDER');
    }
    $heading      = array(
        "en" => str_replace("_", " ", ucfirst($data['subject']))
    );
    $content      = array(
        "en" => $data['message']
    );
    $fields = array(
        'app_id' => $app_id,
        'include_player_ids' => array($user->player_id ?? ''),
        'data' =>  array(
            'type' => $data['type'],
            'id' => $data['id']
        ),
        'headings' => $heading,
        'contents' => $content,
    );
    $fields = json_encode($fields);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        "Authorization:Basic $rest_api_key"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    $childData = array(
        "id" => $data['id'],
        "type" => $data['type'],
        "subject" => $data['subject'],
        "message" => $data['message']
    );
    $notification = \App\Models\Notification::create(
        array(
            'id' => Illuminate\Support\Str::random(32),
            'type' => $data['type'],
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => (int)$user->id ?? 0,
            'data' => json_encode($childData)
        )
    );
}
function saveRequestJobActivity($data)
{
    $admin = \App\Models\AppSetting::first();
    date_default_timezone_set($admin->time_zone ?? 'UTC');
    $data['datetime'] = date('Y-m-d H:i:s');
    $role = auth()->user()->user_type;
    $heading      = array(
        "en" =>  __('messages.post_request_title')
    );
    $content      = array(
        "en" =>  __('messages.post_request_message', ['customer' => $data['post_job']->customer->display_name])
    );
    $fields = array(
        'app_id' => ENV('ONESIGNAL_APP_ID_PROVIDER'),
        'included_segments' => array(
            'ProviderApp'
        ),
        'data' =>  array(
            'post_request_id' => $data['post_job_id'],
            'post_job_name' => $data['post_job']->title,
            'customer_id' => $data['post_job']->customer_id,
            'customer_name' => isset($data['post_job']->customer) ? $data['post_job']->customer->display_name : '',
        ),
        'headings' => $heading,
        'contents' => $content,
    );
    $fields = json_encode($fields);
    $rest_api_key = ENV('ONESIGNAL_REST_API_KEY_PROVIDER');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        "Authorization:Basic $rest_api_key"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
}
function saveJobActivity($data)
{
    $admin = \App\Models\AppSetting::first();
    date_default_timezone_set($admin->time_zone ?? 'UTC');
    $data['datetime'] = date('Y-m-d H:i:s');
    $role = auth()->user()->user_type;
    switch ($data['activity_type']) {
        case "provider_send_bid":
            $data['activity_message'] = __('messages.incomming_bid_message', ['name' =>  $data['bid_data']->provider->display_name, 'price' => $data['bid_data']->price]);
            $data['activity_type'] = __('messages.incomming_bid_title', ['name' =>  $data['bid_data']->provider->display_name]);
            $activity_data = [
                'post_request_id' => $data['bid_data']->post_request_id,
                'provider_id' => $data['bid_data']->provider_id,
                'provider_name' => isset($data['bid_data']->provider) ? $data['bid_data']->provider->display_name : '',
            ];
            $sendTo = ['user'];
            break;
        case "user_accept_bid":
            $data['activity_message'] = __('messages.bid_accepted_message', ['name' => $data['bid_data']->customer->display_name,]);
            $data['activity_type'] =  __('messages.bid_accepted_title');

            $activity_data = [
                'post_request_id' => $data['bid_data']->post_request_id,
                'customer_id' => $data['bid_data']->customer_id,
                'customer_name' => isset($data['bid_data']->customer) ? $data['bid_data']->customer->display_name : '',
            ];

            $sendTo = ['provider'];
            break;
        default:
            $activity_data = [];
            break;
    }
    $data['activity_data'] = json_encode($activity_data);
    \App\Models\BookingActivity::create($data);
    $notification_data = [
        'id'   => $data['bid_data']->id,
        'type' => $data['activity_type'],
        'subject' => $data['activity_type'],
        'message' => $data['activity_message'],
        "ios_badgeType" => "Increase",
        "ios_badgeCount" => 1
    ];
    foreach ($sendTo as $to) {
        switch ($to) {
            case 'admin':
                $user = \App\Models\User::getUserByKeyValue('user_type', 'admin');
                break;
            case 'provider':
                $user = \App\Models\User::getUserByKeyValue('id', $data['bid_data']->provider_id);
                break;
            case 'user':
                $user = \App\Models\User::getUserByKeyValue('id', $data['bid_data']->customer_id);
                break;
        }
        if ($to != 'handyman') {
            sendNotification($to, $user, $notification_data);
        }
    }
}
function getServiceTimeSlot($provider_id)
{
    $admin = \App\Models\AppSetting::first();
    date_default_timezone_set($admin->time_zone ?? 'UTC');

    $current_time = \Carbon\Carbon::now();
    $time = $current_time->toTimeString();

    $current_day = strtolower(date('D'));
    $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

    $slotsArray = [];

    $handyman_count =  \App\Models\User::where('provider_id', $provider_id)->where('is_available', 1)->count();
    $handyman_count = $handyman_count + 1;

    foreach ($days as $value) {

        $slot = \App\Models\ProviderSlotMapping::select('start_at')->where('provider_id', $provider_id)->where('days', $value)->orderBy('start_at', 'asc');
        if ($current_day == $value) {
            $slot = $slot->where('start_at', '>', $time);
        }
        $slot = $slot->get()->pluck('start_at');
        foreach ($slot as $key => $time) {
            $bookings = \App\Models\Booking::where('provider_id', $provider_id)->where('booking_day', $value)->where('booking_slot', $time)->get();
            $booking_count = count($bookings);
            if ($handyman_count == $booking_count) {
                unset($slot[$key]);
                if (gettype($slot) == 'object') {
                    $slot = $slot->toArray();
                }
            }
        }
        $obj = [
            "day" => $value,
            "slot" => $slot,
        ];

        array_push($slotsArray, $obj);
    }
    return $slotsArray;
}
function bookingstatus($status)
{
    switch ($status) {
        case 'Pending':
            $html = '<span class="badge badge-warning ">' . $status . '</span>';

            break;

        case 'Accepted':
            $html = '<span class="badge badge-primary">' . $status . '</span>';

            break;


        case 'Ongoing':
            $html = '<span class="badge badge-warning">' . $status . '</span>';

            break;

        case 'In Progress':
            $html = '<span class="badge badge-info">' . $status . '</span>';

            break;

        case 'Hold':
            $html = '<span class="badge badge-dark">' . $status . '</span>';

            break;

        case 'Cancelled':
            $html = '<span class="badge badge-danger">' . $status . '</span>';

            break;

        case 'Rejected':
            $html = '<span class="badge badge-light">' . $status . '</span>';

            break;

        case 'Completed':
            $html = '<span class="badge badge-success">' . $status . '</span>';

            break;

        default:
            $html = '<span class="badge badge-danger">' . $status . '</span>';
            break;
    }
    return $html;
}

function sendWhatsAppText($jobid, $status)
{
    $job = \App\Models\Jobs::find($jobid);

    $user = \App\Models\User::find($job->user_id);

    if ($user && $user->first_name != null) {
        $userName = $user->first_name;
    } else {
        $userName = $job->contact_number;
    }

    $mobile_number = $job->contact_number; //$booking->contact_number;
    $endDate = date('d-m-Y', strtotime($job->end_date));
    $templateId = '9ab51226-db07-4a56-89a1-466828a587ef';

    switch ($status) {
        case 'failed':

            $variables = array(
                '{data}' => "அன்பார்ந்த *{$userName}*/, வணக்கம் 🙏\n\n⛔ உங்கள் வேலை வாய்ப்பு  பதிவுக்கான பணம் செலுத்த முடியவில்லை. ❌\n\n*நிறுவனம்:* {$job->company_name}\n*வேலை பெயர்:* {$job->job_role}\n*காலியிடம்:* {$job->vacancy}\n*வேலை எண்:* {$job->id}\n*முற்றுப்பெறும் நாள்:* {$endDate}\n\n```Regards Tamilanjobs```\n\nநன்றி 🙏 "

            );
            break;

        case 'paid':

            $variables = array(
                '{data}' => "அன்பார்ந்த *{$userName}* வணக்கம்! 🙏\n\n✅ உங்கள் வேலை வாய்ப்பு  பதிவுக்கான பணம் செலுத்தப்பட்டது. 👍\n\n*நிறுவனம்:* {$job->company_name}\n*வேலை பெயர்:* {$job->job_role}\n*காலியிடம்:* {$job->vacancy}\n*வேலை எண்:* {$job->id}\n*முற்றுப்பெறும் நாள்:* {$endDate}\n\n```தமிழன் ஜாப்ஸ் மூலம் நீங்கள் சிறந்த பணியாட்களை பெற வாழ்த்துக்கள் 🙏```\n\n_Support: 8233823308_"
            );
            break;

        case 'job_post':

            $variables = array(

                '{data}' => "அன்பார்ந்த *{$userName}*! வணக்கம் 🙏,\n\nஉங்கள் வேலைவாய்ப்பு பதிவு வெற்றிகரமாக பதிவிடப்பட்டது.👍\n\nஎங்கள் வாடிக்கையாளர் சேவை அதிகாரி/ நிர்வாகி உங்களை தொடர்பு கொண்டு உங்கள் நிறுவனம் சம்பந்தப்பட்ட சரிபார்ப்புகளை முடித்த பிறகு உங்கள் பதிவு நேரலையில் கொண்டுவரப்படும்.\n\nஅழைப்பு வரும் வரை தயவுசெய்து காத்திருக்கவும். \n\n*நிறுவனம்:* {$job->company_name}\n*வேலை பெயர்:* {$job->job_role}\n*Vacancies:* {$job->vacancy}\n*வேலை எண்:* {$job->id}\n*முற்றுப்பெறும் நாள்:* {$endDate}\n\n```We appreciate your trust in Tamilanjobs ```\n\n_Support: 8233823308_ \n\nநன்றி!🙏",

            );
            break;

        case 'featured':

            $variables = array(
                '{data}' => "அன்பார்ந்த *{$userName}*! வணக்கம் 🙏, \n\nஉங்கள் வேலை வாய்ப்பு தகவல் தமிழன் ஜாப்ஸ் பிரீமிம் (Featured Jobs)-இல் கொண்டுவரபட்டுள்ளது. 👑. \n\n*நிறுவனம்:* {$job->company_name}\n*வேலை பெயர்:* {$job->job_role}\n\n```உங்கள் வெற்றி எங்கள் வெற்றி, நன்றி🙏```\n\n_Support: 8233823308_"
            );
            break;


        case 'active':

            $variables = array(
                '{data}' => "அன்பார்ந்த *{$userName}*! வணக்கம் 🙏, \n\nஉங்கள் வேலை வாய்ப்பு தமிழன் ஜாப்ஸ் நேரலையில் கொண்டுவரப்பட்டது. ✅. \n\n*நிறுவனம்:* {$job->company_name}\n*வேலை பெயர்:* {$job->job_role}\n*காலியிடம்:* {$job->vacancy}\n*வேலை எண்:* {$job->id}\n*முற்றுப்பெறும் நாள்:* {$endDate}\n\n```உங்கள் வெற்றி எங்கள் வெற்றி, நன்றி🙏```\n\n_Support: 8233823308_"
            );
            break;

        case 'rejected':
       
            $variables = array(
                '{data}' => "அன்பார்ந்த, *{$userName}*! வணக்கம் 🙏, \n\n⚠️ உங்கள் வேலை வாய்ப்பு பதிவு நிராகரிக்கப்படுகிறது ⚠️.\n\nஉங்கள் வேலைவாய்ப்பு பதிவானது எங்கள் சரிபார்ப்பு குழுவின் (Verification ) அழைப்பினை ஏற்காததால் அல்லது எங்கள் நிபந்தனை நிபந்தனைகளுக்கு உட்படாததால் நிராகரிக்கப்படுகிறது.\n\nமேலும் விவரமறிய 8233823308 என்ற எண்ணை காலை 9 மணி முதல் மாலை 6 மணி வரை அழைக்கலாம். நன்றி"
            );
            break;

        case 'suspended':
            $variables = array(
                '{data}' => "அன்பார்ந்த *{$userName}*! வணக்கம் 🙏,,\n\n⚠️ உங்கள் வேலை வாய்ப்பு பதிவு நிராகரிக்கப்படுகிறது ⚠️.\n\nஉங்கள் வேலைவாய்ப்பு பதிவானது எங்கள் சரிபார்ப்பு (Verification ) அழைப்பினை ஏற்காததால் அல்லது எங்கள் நிபந்தனை நிபந்தனைகளுக்கு உட்படாததால் நிராகரிக்கப்படுகிறது\n\nமேலும் விவரமறிய 8233823308 என்ற எண்ணை காலை 9 மணி முதல் மாலை 6 மணி வரை அழைக்கலாம். நன்றி"
            );
            break;

        case 'inactive':

            $variables = array(
                '{data}' => "அன்பார்ந்த *{$userName}*! வணக்கம் 🙏,\n\n⚠️ உங்கள் வேலை வாய்ப்பு பதிவு நிராகரிக்கப்படுகிறது ⚠️.\n\nஉங்கள் வேலைவாய்ப்பு பதிவானது எங்கள் சரிபார்ப்பு (Verification ) அழைப்பினை ஏற்காததால் அல்லது எங்கள் நிபந்தனை நிபந்தனைகளுக்கு உட்படாததால் நிராகரிக்கப்படுகிறது\n\nமேலும் விவரமறிய 8233823308 என்ற எண்ணை காலை 9 மணி முதல் மாலை 6 மணி வரை அழைக்கலாம். நன்றி"

            );
            break;

        case 'expiry':

            $variables = array(
                '{data}' => "Hello {$userName}, just letting you know that your job post with ID: {$job->id} has now expired."
            );
            break;

        case 'today_expiry':
            $variables = array(
                '{data}' => "வணக்கம் 🙏 \n\nதமிழன் ஜாப்ஸ் நினைவூட்டல் உங்கள் வேலை வாய்ப்பு பதிவு எண் {$job->id} என்ற பதிவு இன்று முற்றுப்பெறவுள்ளது ⏲️.\n\n*நிறுவனம்:* {$job->company_name}\n*வேலையின் பெயர்:* {$job->job_role}\n*காலியிடம்:* {$job->vacancy}\n*வேலை எண்:* {$job->id}\n*முற்றுப்பெறும் நாள்:* {$endDate}\n\n```நீங்கள் தொடர்ந்து வெற்றியடைய தமிழன் ஜாப்ஸ் எப்போதும் வாழ்த்துகிறது```\n\n_Support: 8233823308_"
            );
            break;

        case 'tmrw_expiry':
            $variables = array(
                '{data}' => "வணக்கம் 🙏 \n\nதமிழன் ஜாப்ஸ் நினைவூட்டல் உங்கள் வேலை வாய்ப்பு பதிவு எண் {$job->id} என்ற பதிவு நாளை முற்றுப்பெறவுள்ளது ⏲️.\n\n*நிறுவனம்:* {$job->company_name}\n*வேலையின் பெயர்:* {$job->job_role}\n*காலியிடம்:* {$job->vacancy}\n*வேலை எண்:* {$job->id}\n*முற்றுப்பெறும் நாள்:* {$endDate}\n\n```நீங்கள் தொடர்ந்து வெற்றியடைய தமிழன் ஜாப்ஸ் எப்போதும் வாழ்த்துகிறது```\n\n_Support: 8233823308_"
            );
            break;

        default:
            $variables = array(
                '{data}' => "Hello *{$userName}*, \njust a friendly reminder that your job post with ID: {$job->id} is set to expire tomorrow.\n\n ```Continued success to you, Regards Tamilanjobs ```"
            );
            break;
    }



    $curl = curl_init();

    $postFields = array(
        'appkey' => 'f968d928-adbd-4fb5-895d-21a2c07a4d10',
        'authkey' => 'vWreQ9PltLOtQmAvDCkbJXWsVomnDnLOMnChOzK9iZENWR6K3o',
        'to' => '+91' . $mobile_number,
        'template_id' => $templateId,
        'variables' => $variables // convert the array into a JSON string
    );

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://server.apiwasender.com/api/create-message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>  http_build_query($postFields),
        CURLOPT_SSL_VERIFYPEER => false,
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($curl);
    } else {
        $response;
    }


    curl_close($curl);

    return $response;
}
function sendWhatsAppTextToExecutivePay($jobid, $status)
{
    $job = \App\Models\Jobs::find($jobid);
    $user = \App\Models\User::find($job->user_id);
    $payment = \App\Models\JobsPayment::find($job->payment_id);

    if ($payment && $payment != null) {
        $amount = $payment->total_amount ?? "0";
    } else {
        $amount = "0";
    }

    if ($user && $user->first_name != null) {
        $userName = $user->first_name . $user->last_name ?? '';
    } else {
        $userName = $job->contact_number ?? '';
    }

    $mobileNumbers = ['8675002943', '9655008990']; //$booking->contact_number;
    $templateId = '9ab51226-db07-4a56-89a1-466828a587ef';

    switch ($status) {

        case 'paid':
            $variables = array(
                '{data}' => "Payment Paid ✅\n\n, The job with ID: {$job->id} payment has been paid successfully.✅ \n\n *Name:* {$userName}\n\n *Contact Number:* {$job->contact_number}\n *Amount:* {$amount}, \n\n *Company:* {$job->company_name}\n *Post Name:* {$job->job_role}\n *Vacancies:* {$job->vacancy}\n *Job ID:* {$job->id}\n\n_Support: 8233823308_",
            );
            break;
        case 'failed':
            $variables = array(
                '{data}' => "Payment Failed ❌\n\n, The job with ID: {$job->id} payment has been failed.❌ \n\n*Contact Number:* {$job->contact_number}\n*Company:* {$job->company_name}\n*Post Name:* {$job->job_role}\n*Vacancies:* {$job->vacancy}\n*Job ID:* {$job->id}\n\n_Support: 8233823308_",
            );
            break;
    }



    $curl = curl_init();

    foreach ($mobileNumbers as $mobile_number) {
        $postFields = array(
            'appkey' => '4881561c-3d5e-4370-af32-571773b0bab0',
            'authkey' => 'FL424q6knyBhVolmNWSzT2jlNCpnzIwpivPtytmyXLOHAIclHA',
            'to' => '+91' . $mobile_number,
            'template_id' => $templateId,
            'variables' => $variables // convert the array into a JSON string
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://server.apiwasender.com/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  http_build_query($postFields),
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $response;
        }
    }

    curl_close($curl);

    return $response;
}



function sendWhatsAppTextToExecutive($jobid, $status)
{
    $job = \App\Models\Jobs::find($jobid);

    $mobileNumbers = ['8675002943', '9655008990']; //$booking->contact_number;
    $templateId = '9ab51226-db07-4a56-89a1-466828a587ef';

    switch ($status) {
        case 'job_post':
            $variables = array(
                '{data}' => "Job post Received ✅ \n\n, The job with ID: {$job->id} has been posted successfully. \n\n *Company:* {$job->company_name}\n*Contact Number:* {$job->contact_number}\n*Post Name:* {$job->job_role}\n*Vacancies:* {$job->vacancy}\n*Job ID:* {$job->id}\n\nco: 8233823308_",
            );
            break;
    }



    $curl = curl_init();

    foreach ($mobileNumbers as $mobile_number) {
        $postFields = array(
            'appkey' => '4881561c-3d5e-4370-af32-571773b0bab0',
            'authkey' => 'FL424q6knyBhVolmNWSzT2jlNCpnzIwpivPtytmyXLOHAIclHA',
            'to' => '+91' . $mobile_number,
            'template_id' => $templateId,
            'variables' => $variables // convert the array into a JSON string
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://server.apiwasender.com/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  http_build_query($postFields),
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $response;
        }
    }

    curl_close($curl);




    return $response;
}


function sentSMS($contacts, $text)
{


    // $api_key = 'ca2b0f99-5cea-4447-9635-b2d94b0c81a3';
    // $ClientId ="c5aa5dc4-e92f-43de-90a0-3d20807162d8";
    // $id = 'XTTECH';
    // $sms_text = "Welcome to XTTECH Dear jobs7 your OTP is $otp";
    // date_default_timezone_set("Asia/Calcutta");
    // $newtimestamp = strtotime(date('Y-m-d H:i:s').'+1 minute');
    // $dateTime = date('Y-m-d H:i:s', $newtimestamp);

    // $api_url = str_replace(' ', '+', "https://sms.nettyfish.com/api/v2/SendSMS?ApiKey=$api_key&ClientId=$ClientId&SenderId=$id&Message=$sms_text&MobileNumbers=$contacts&Is_Unicode=true&Is_Flash=true&SchedTime=$dateTime");

    // $curl = curl_init();
    // curl_setopt_array($curl, array(
    // CURLOPT_RETURNTRANSFER => 1,
    // CURLOPT_URL => $api_url

    // ));
    // $Response = curl_exec($curl);
    // $retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // if ($retcode == 200) {
    //     return true;
    // } else {
    //    return false;

    // }
    // curl_close($curl);
    // Account details

    #################################################################################################################
    // $apiKey = urlencode('NzQ0NDQ2NDk2YTU0Mzc0MTc1MzY0ZDU2NDg1NjU1Mzc=');

    // // Message details
    // $numbers = array($contacts);
    // $sender = urlencode('TAMLAN');


    // $message = rawurlencode($otp . ' is your OTP to verify your mobile number on the Jobs7 app/website.' . $signCode);

    // $numbers = implode(',', $numbers);

    // //  Prepare data for POST request
    // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

    // // Send the POST request with cURL
    // $ch = curl_init('https://api.textlocal.in/send/');
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // $res = json_decode($response);


    // if ($res->status == 'success') {
    //     return $data['status'] = "Success";
    // } else {
    //     return $data['status'] = "Failure";
    // }


    // exit();
    //----------------------------------------------------sms my dream----------------------------------------------------------- 

    // $key = "gIzOiWdbFTqrCWVq";
    // $mbl = $contacts;     /*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
    // //$message_content=urlencode(''.$otp.' is your OTP to verify your mobile number on the Jobs7 app/website. '.$org);
    // $message_content = urlencode($otp . ' is your verification code for Tamilanjobs - Find Jobs Locally. ' . $signCode);

    // $senderid = "TAMLAN";

    // $url = "http://app.mydreamstechnology.in/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content";

    // $output = file_get_contents($url);    /*default function for push any url*/

    // return json_decode($output, true);
    // exit();

    //return json_decode($output, true);   
    //return [
    //  'status' => 'Success',
    // 'message' => 'Please Enter Valid OTP for login'

    // ];
    //----------------------------------------------------sms eagleminds tech----------------------------------------------------------- 
    $key = "nPD1MSa7HP0NczP0";
    $mbl = '91'.$contacts;     /*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
    // //$message_content=urlencode(''.$otp.' is your OTP to verify your mobile number on the Jobs7 app/website. '.$org);
    $message_content = urlencode('http://bit.ly/3IE6Vue is your verification code for Tamilanjobs - Find Jobs Locally. Nammav2app');

    $senderid = "TAMLAN";

    $url = "https://sms.eagleminds.net/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content";

    $output = file_get_contents($url);    /*default function for push any url*/

    return json_decode($output, true);
    exit();
}
