<?php

namespace App\Services;
use Bpjs\Framework\Helpers\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    // Service logic here
    public function generate($html, $filename = 'document.pdf')
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream($filename, ["Attachment" => false]);
    }
}
