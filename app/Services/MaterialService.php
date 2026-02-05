<?php

namespace App\Services;
use App\Models\Materials;
use App\Repository\MaterialRepository;
use Bpjs\Framework\Helpers\Validator;

class MaterialService
{
    // Service logic here
    public function __construct(protected MaterialRepository $repo){}
    public function createMaterial(array $data)
    {
        $validate = $this->validate($data);
        if($validate){
            return [
                'success' => false,
                'status' => 422,
                'message' => $validate
            ];
        }
        if($this->MoldIsExsist($data['mold_number'])){
            return [
                'success' => false,
                'status' => 400,
                'message' => 'Mold Already Exsist'
            ];
        }

        $material = $this->repo->createMaterial($data);

        return [
            'success' => true,
            'status' => 200,
            'data' => $material
        ];
    }

    public function updateMaterial($id, array $data)
    {
        $attributes = [
            'mold_number' => $id,
            'model_name' => $data['model_name'],
            'lamp_name' => $data['lamp_name'],
            'type_material' => $data['type_material'],
        ];
        $material = $this->repo->updateMaterial($attributes);
        return [
            'success' => true,
            'status' => 200,
            'data' => $material
        ];
    }

    public function deleteMaterial($id)
    {
        $material = $this->repo->deleteMaterial($id);
        return [
            'success' => true,
            'status' => 200,
            'data' => $material
        ];
    }

    private function validate(array $data)
    {
        $validate = Validator::make($data,
        [
            'mold_number' => 'required',
            'lamp_name' => 'required',
            'model_name' => 'required',
            'type_material' => 'required',
        ],
        [
            'mold_number.required' => 'Mold number is required',
            'lamp_name.required' => 'Lamp Name is required',
            'model_name.required' => 'Model Name is required',
            'type_material.required' => 'Type is required',
        ]
        );
        return $validate;
    }

    private function MoldIsExsist($param)
    {
        $material = Materials::query()->where('mold_number','=',$param)->first();
        return $material ? true : false;
    }
}
