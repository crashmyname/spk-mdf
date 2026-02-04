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
        $material = $this->repo->updateMaterial($data);
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
            'type' => 'required',
        ],
        [
            'username.required' => 'Username is required',
            'lamp_name.required' => 'Lamp Name is required',
            'model_name.required' => 'Model Name is required',
            'type.required' => 'Type is required',
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
