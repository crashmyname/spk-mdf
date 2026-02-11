<?php

namespace App\Controllers;

use App\DTO\DetailTicket\DetailTicketDTO;
use App\Models\DetailTicket;
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

    public function getDetail($id)
    {
        $decId = Crypto::decrypt($id);
        $detail = DetailTicket::query()->where('ticket_id','=',$decId)->get();
        if($detail){
            return Response::json([
                'status' => 200,
                'message' => 'data found',
                'data' => DetailTicketDTO::collection($detail)
            ],200);
        } else {
            return Response::json([
                'status' => 404,
                'message' => 'data not found',
                'data' => []
            ],404);
        }
    }

    public function show($id)
    {
        // Tampilkan resource dengan ID: $id
    }

    public function store(Request $request)
    {
        // Simpan resource baru
    }

    public function update(Request $request, $id)
    {
        // Update resource dengan ID: $id
    }

    public function destroy($id)
    {
        // Hapus resource dengan ID: $id
    }
}
