<?php

namespace App\DTO\Material;

use App\Models\Materials;

final class MaterialDTO
{
    // DTO here
    public function __construct(
        public string $mold_number,
        public string $lamp_name,
        public string $model_name,
        public string $type_material
    ){}

    public static function getMaterialDTO(Materials $material)
    {
        return new self(
            $material->mold_number,
            $material->lamp_name,
            $material->model_name,
            $material->type_material,
        );
    }
}
