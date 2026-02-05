<?php

namespace App\Controllers;

use App\Services\TiketService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class TicketController extends BaseController
{
    public function index()
    {
        $title = 'SPK';
        return view('ticket/ticket',compact('title'),'layout/app');
    }

    public function show($id)
    {
        // Tampilkan resource dengan ID: $id
    }

    public function store(Request $request, TiketService $service)
    {
        $result = $service->createTicket($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function update(Request $request, $id, TiketService $service)
    {
        $result = $service->updateTicket($id,$request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function destroy($id)
    {
        // Hapus resource dengan ID: $id
    }
}
