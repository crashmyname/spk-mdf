<?php

namespace App\Import;

use App\Models\Materials;
use Bpjs\Framework\Helpers\Importer;

class MaterialImport extends Importer
{
    // Import logic here
    public function handle(array $mappedRow, int $index): mixed
    {
        $material = Materials::query()->where('mold_number','=',$mappedRow['mold_number'])->first();
        if ($material) {
            return [
                'row' => $index + 1,
                'status' => 'skipped',
                'mold_number' => $mappedRow['mold_number'] ?? null,
                'message' => 'mold number sudah ada.'
            ];
        }
        Materials::create([
            'mold_number' => $mappedRow['mold_number'],
            'lamp_name' => $mappedRow['lamp_name'],
            'model_name' => $mappedRow['model_name'],
            'type_material' => $mappedRow['type_material'],
        ]);

        return [
            'row' => $index + 1,
            'status' => 'success',
            'mold_number' => $mappedRow['mold_number'] ?? null,
            'message' => 'Berhasil import material.'
        ];
    }
}
