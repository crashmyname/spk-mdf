<?php

namespace App\DTO\Material;

use App\Models\Materials;

final class MaterialDTO
{
    // DTO here
    public function __construct(
        public string $moldNumber,
        public string $lampName,
        public string $modelName,
        public string $type
    ){}

    public static function getMaterialDTO(Materials $material)
    {
        return new self(
            $material->mold_number,
            $material->lamp_name,
            $material->model_name,
            $material->type,
        );
    }
}
