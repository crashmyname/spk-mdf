<?php

namespace App\Controllers;

use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Http;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class ApiController extends BaseController
{
    // Controller logic here
    public function getEmployee(Request $request)
    {
        try {
            $api = Http::get(env('API_DATA').$request->nik.'&api_key='.env('API_KEY'));
            if($api !== null){
                return Response::json(['status' => 200, 'data' => $api['response'][0]]);
            }
        } catch (\Exception $e){
            return Response::json(['status' => 500, 'message' => 'Server Error']);
        }
    }
}
