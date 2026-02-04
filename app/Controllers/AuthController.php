<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\AuthService;
use Bpjs\Framework\Helpers\Auth;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class AuthController extends BaseController
{
    // Controller logic here

    public function index()
    {
        return view('auth/login');
    }

    public function onLogin(Request $request, AuthService $service)
    {
        $login = $service->login($request->all());
        return Response::json([
            'status' => $login['status'],
            'message' => $login['message'] ?? 'success',
            'data' => $login['data'] ?? null
        ],$login['status']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
