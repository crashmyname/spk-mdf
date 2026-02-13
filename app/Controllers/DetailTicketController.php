<?php

namespace App\Controllers;

use App\DTO\DetailTicket\DetailTicketDTO;
use App\Models\DetailTicket;
use App\Services\DetailTicketService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Crypto;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class DetailTicketController extends BaseController
{
    public function index()
    {
        // Tampilkan semua resource
    }

    public function getDetail($id, DetailTicketService $service)
    {
        $decId = Crypto::decrypt($id);
        $result = $service->getDetailReq($decId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function getDetailAct($id, DetailTicketService $service)
    {
        $decId = Crypto::decrypt($id);
        $result = $service->getDetailAct($decId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function show($id)
    {
        // Tampilkan resource dengan ID: $id
    }

    public function store(Request $request)
    {
        // Simpan resource baru
    }

    public function updateReq(Request $request, DetailTicketService $service)
    {
        $result = $service->updateReq($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function destroyReq($id, DetailTicketService $service)
    {
        $result = $service->destroyReq($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }
    public function updateAct(Request $request, DetailTicketService $service)
    {
        $result = $service->updateAct($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function destroyAct($id, DetailTicketService $service)
    {
        $result = $service->destroyAct($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }
}
