<?php

namespace App\Controllers;

use App\Import\MaterialImport;
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
                        ->select('mold_number','lamp_name','model_name','type_material')
                        ->searchable([
                            'mold_number',
                            'lamp_name',
                            'model_name',
                            'type_material'
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

    public function import(Request $request)
    {
        // vd($request->all());
        if (!$request->file('file')) {
            return Response::json(['status' => 500, 'message' => 'File tidak ada'],500);
        }
        $validateType = $request->getClientMimeType('file');
        $allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
        if($request->file('file') && !in_array($validateType,$allowedTypes)){
            $errors = ['file' => ['File must be a valid excel file']];
        }
        if(!empty($errors)){
            return Response::json(['status'=>500,'message'=>$errors],500);
        }
        $path = storage_path('material/');
        if (!is_dir($path)) mkdir($path, 0777, true);
        $file = $request->file('file');
        $filename = uniqid('import_material_') . '.' . $request->getClientOriginalExtension('file');
        $filePath = $path . $filename;
        store($file['tmp_path'],$path, $filename);

        $import = new MaterialImport($filePath,[
            'hasHeader' => true,
            'sheetName' => 'Sheet1'
        ]);
        $results = $import->import();
        return Response::json([
            'status' => 200,
            'message' => 'Import selesai',
            'results' => $results,
        ],200);
    }

    public function create(Request $request, MaterialService $service)
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
