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
    public function addCompany(Request $request)
    {
        $data = $request->all();    
        $result = Company::create($data);      
        $status_code = 200;
        

        if($result->payment_status == 'failed')
        {
            $status_code = 400;
        }
        return comman_message_response($result,$status_code);
    }
}
