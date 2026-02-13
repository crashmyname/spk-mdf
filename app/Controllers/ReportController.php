<?php

namespace App\Controllers;

use App\Models\Ticket;
use App\Services\PdfService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class ReportController extends BaseController
{
    // Controller logic here
    public function index()
    {
        // return view('')
        $ticket = Ticket::query()->where('ticket_id','=',1)->first();

        $data = [
            'no_order' => $ticket->no_order,
            'date_create' => $ticket->date_create,
            'dept' => $ticket->dept,
            'model' => $ticket->model,
            'mold_name' => $ticket->mold_name,
            'lot_shot' => $ticket->lot_shot,
            'total_shot' => $ticket->total_shot,
            'detail' => $ticket->detail_id
        ];

        $html = View::path('reports/template',compact('data'));

        $pdf = new PdfService();
        $pdf->generate($html, 'spk.pdf');
    }
}
