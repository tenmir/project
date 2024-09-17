<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendSuccess($result, $status = 200) 
    {
        return Response::json(
            [
                'success' => true,
                'data'    => $result
            ], 
            $status
        );
    }

    public function sendError($result, $status = 400) 
    {
        return Response::json(
            [
                'success' => false,
                'data'    => $result
            ], 
            $status
        );
    }
}
