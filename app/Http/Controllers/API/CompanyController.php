<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\WalletHistory;
use App\Http\Resources\API\WalletHistoryResource;

class CompanyController extends Controller
{
    public function addCompanyData(Request $request)
    {
        $data = $request->all();    
        $result = Company::updateOrCreate(['id' => $request->id], $data);     
        $status_code = 200;
        

        if($result->payment_status == 'failed')
        {
            $status_code = 400;
        }
        return comman_message_response($result,
        $status_code);
    }
    public function addCompany(Request $request)
    {
        $user_favourite = $request->all();

        $result = Company::updateOrCreate(['id' => $request->id], $user_favourite);

        $message = __('messages.update_form',[ 'form' => __('Company') ] );
		if($result->wasRecentlyCreated){
			$message = __('messages.save_form',[ 'form' => __('Company') ] );
		}

        return comman_message_response($message);
    }
}
