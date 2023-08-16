<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function responseJson($message = '', $data = null, $statusCode = 200,$success = true){
        return response([
            'success'=>$success,
            'message'=>$message,
            'data'=>$data
        ],$statusCode);
    }
}
