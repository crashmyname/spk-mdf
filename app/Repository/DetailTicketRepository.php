<?php

namespace App\Repository;

use App\Models\DetailAct;
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

    public function req($id)
    {
        $detail = DetailTicket::query()->where('ticket_id','=',$id)->get();
        return $detail;
    }

    public function act($id)
    {
        $detailact = DetailAct::query()->where('ticket_id','=',$id)->get();
        return $detailact;
    }

    public function createAct(array $data)
    {
        $req = [
            'ticket_id' => Crypto::decrypt($data['hashact']),
            'act_repair' => $data['act_repair'],
            'date_act' => $data['date_act'],
            'act_by' => $data['act_by'],
            'total_hours_act' => $data['total_hours_act'] ?? null,
        ];
        $detailact = DetailAct::create($req);
        return $detailact->toArray();
    }
}
