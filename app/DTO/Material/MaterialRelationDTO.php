<?php

namespace App\DTO\Material;

final class MaterialRelationDTO
{
    // DTO here
    public function __construct(
        public string $mold_number,
        public string $lamp_name,
        public string $model_name,
        public string $type_material
    ){}
}
