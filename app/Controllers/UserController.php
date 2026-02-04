<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Services\UserService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class UserController extends BaseController
{
    // Controller logic here
    public function index()
    {
        $title = 'Management User';
        return view('master/users',compact('title'),'layout/app');
    }

    public function getUser(Request $request)
    {
        return TablePlus::of('users')
                        ->select('username','name','section','email','role')
                        ->searchable([
                            'username',
                            'name',
                            'section',
                            'email',
                            'role'
                        ])
                        ->filters($request->input('filters',[]) ?? [])
                        ->orderBy('user_id', 'DESC')
                        ->paginate($request->per_page ?? 10, $request->page ?? 1)
                        ->handleDistinct($request->distinct ?? null)
                        ->make();
    }

    public function show(UserService $service, $id)
    {
        $user = $service->getData($id);
        return vd($user);
    }

    public function create(Request $request, UserService $service)
    {
        $result = $service->createUser($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function update(Request $request, $id, UserService $service)
    {
        $result = $service->updateUser($id, $request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ],$result['status']);
    }

    public function delete($id, UserService $service)
    {
        $result = $service->deleteUser($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ],$result['status']);
    }
}
