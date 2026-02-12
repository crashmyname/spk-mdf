<?php

namespace App\Controllers;

use App\Models\Materials;
use App\Models\Ticket;
use App\Services\DetailTicketService;
use App\Services\MaterialService;
use App\Services\TiketService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Crypto;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class TicketController extends BaseController
{
    public function index(MaterialService $materialService)
    {
        $title = 'SPK';
        $material = $materialService->getMaterial();
        return view('ticket/ticket',compact('title','material'),'layout/app');
    }

    public function getMaterial(MaterialService $materialService)
    {
        $material = $materialService->getMaterial();
        return Response::json([
            'status' => 200,
            'message' => 'success',
            'data' => $material
        ],200);
    }

    public function show($id)
    {
        // Tampilkan resource dengan ID: $id
    }

    public function getTicket(Request $request)
    {
       TablePlus::of('ticket')
                        ->leftJoin('users','users.user_id','=','ticket.user_id')
                        ->leftJoin('material','material.material_id','=','ticket.material_id')
                        ->select('no_order','date_create','users.username','users.name','action','type_ticket','material.mold_number','material.model_name','material.lamp_name','material.type_material','lot_shot','total_shot','sketch_item','options','ticket_id','ticket.user_id','ticket.material_id')
                        ->searchable([
                            'no_order',
                            'date_create',
                            'users.username',
                            'users.name','action','type_ticket','material.mold_number','material.model_name','material.lamp_name','material.type_material','lot_shot','total_shot','sketch_item','options'
                        ])
                        ->addColumn('ticket_hash', function ($row) {
                            return Crypto::encrypt($row['ticket_id']);
                        })
                        ->filters($request->input('filters',[]) ?? [])
                        ->orderBy('ticket_id','ASC')
                        ->paginate($request->per_page ?? 10, $request->page ?? 1)
                        ->handleDistinct($request->distinct ?? null)
                        ->make();
    }

    public function store(Request $request, TiketService $service)
    {
        $result = $service->createTicket($request->all(),$request->file('file_sketch'));
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function update(Request $request, $id, TiketService $service)
    {
        $decId = Crypto::decrypt($id);
        $result = $service->updateTicket($decId,$request->all(), $request->file('file_sketch'));
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function destroy($id, TiketService $service)
    {
        $decId = Crypto::decrypt($id);
        $result = $service->deleteTicket($decId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function DetailTicket(Request $request, $id)
    {
        $title = 'Detail SPK';
        $ticket = Ticket::find(Crypto::decrypt($id));
        return view('ticket/detail-ticket',compact('title','id','ticket'),'layout/app');
    }

    public function addDetailRequest(Request $request, DetailTicketService $service)
    {
        $result = $service->create($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function addDetailActual(Request $request, DetailTicketService $service)
    {
        $result = $service->createAct($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }
}
