<?php

namespace App\Repository;

use App\Models\DetailTicket;
use Bpjs\Framework\Helpers\Crypto;

class DetailTicketRepository
{
    // Repository here
    public function create(array $data)
    {
        $req = [
            'ticket_id' => Crypto::decrypt($data['hash']),
            'detail_item' => $data['detail_item'],
            'repair_req' => $data['repair_req'],
            'date_repair' => $data['date_repair'],
            'repair_by' => $data['repair_by'],
            'total_hours_plan' => $data['total_hours_plan'] ?? null
        ];
        $detail = DetailTicket::create($req);
        return $detail->toArray();
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
