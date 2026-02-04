<?php

namespace App\Repository;

use App\Models\Materials;

class MaterialRepository
{
    // Repository here
    public function getMaterialById($data)
    {
        $material = Materials::query()->where('mold_number','=',$data)->first();
        return $material;
    }

    public function createMaterial(array $data)
    {
        $request = [
            'mold_number' => $data['mold_number'],
            'lamp_name' => $data['lamp_name'],
            'model_name' => $data['model_name'],
            'type' => $data['type'],
        ];
        $material = Materials::create($request);
        return $material;
    }

    public function updateMaterial(array $data)
    {
        $conditions = [
            'mold_number' => $data['mold_number']
        ];
        $material = Materials::query()->where('mold_number','=',$conditions['mold_number'])->first()
                    ->update($data);
        return $material;
    }

    public function deleteMaterial($id)
    {
        $material = Materials::query()->where('mold_number','=',$id)->first();
        $material->delete();
        return $material;
    }
}
