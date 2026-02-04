<?php

namespace App\Controllers;

use App\Services\MaterialService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class MaterialController extends BaseController
{
    public function index()
    {
        // Tampilkan semua resource
        $title = 'Management Material';
        return view('master/materials',compact('title'),'layout/app');
    }

    public function getMaterial(Request $request)
    {
        return TablePlus::of('material')
                        ->select('mold_number','lamp_name','model_name','type')
                        ->searchable([
                            'mold_number',
                            'lamp_name',
                            'model_name',
                            'type'
                        ])
                        ->filters($request->input('filters',[]) ?? [])
                        ->orderBy('material_id','ASC')
                        ->paginate($request->per_page ?? 10, $request->page ?? 1)
                        ->handleDistinct($request->distinct ?? null)
                        ->make();
    }

    public function show($id)
    {
        // Tampilkan resource dengan ID: $id
    }

    public function store(Request $request, MaterialService $service)
    {
        $result = $service->createMaterial($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function update(Request $request, $id, MaterialService $service)
    {
        $result = $service->updateMaterial($id, $request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }

    public function destroy($id, MaterialService $service)
    {
        $result = $service->deleteMaterial($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null,
        ],$result['status']);
    }
}
