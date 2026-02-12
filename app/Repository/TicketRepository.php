<?php

namespace App\Repository;

use App\DTO\Approval\ApprovalDTO;
use App\DTO\Ticket\TicketDTO;
use App\Models\Approval;
use App\Models\Materials;
use App\Models\Ticket;
use Bpjs\Framework\Helpers\Char;
use Bpjs\Framework\Helpers\Date;
use Bpjs\Framework\Helpers\Session;

class TicketRepository
{
    // Repository here
    public function getTicketById($data)
    {
        $ticket = Ticket::find($data)->load(['material','user']);
        return $ticket;
    }

    public function createTicket(array $data)
    {
        $getMaterialId = Materials::query()->where('mold_number','=',$data['material'])->first();
        $attribute = new TicketDTO(
            $data['no_order'],
            $data['date_create'],
            $data['user_id'],
            $data['action'],
            $data['type_ticket'],
            $getMaterialId->material_id,
            $data['lot_shot'],
            $data['total_shot'],
            $data['file_sketch']['name'],
            'null',
        );
        $dataInsert = $attribute->toArray();
        $maxRetry = 5;
        $attempt = 0;

        do {
            try {
                $dataInsert['uuid'] = Char::uuid();
                $ticket = Ticket::create($dataInsert);
                break;
            } catch (\Exception $e) {
                if (!str_contains($e->getMessage(), 'uuid')) {
                    throw $e;
                }

                $attempt++;

                if ($attempt >= $maxRetry) {
                    throw new \Exception('Failed generate unique UUID');
                }

            }

        } while ($attempt < $maxRetry);
        
        if($ticket){
            $attribueApproval = new ApprovalDTO(
                $ticket->ticket_id,
                Session::user()->username,
                $data['date_create'],
                null,
                null,
                null,
                null,
                null,
                null,
                'on process',
                null,
            );
            Approval::create($attribueApproval);
        }
        return $ticket;
    }

    public function findById($id)
    {
        $ticket = Ticket::find($id);
        return $ticket;
    }

    public function updateTicket(array $data, $id)
    {
        $data['updated_at'] = Date::Now();
        $ticket = Ticket::find($id)
                    ->update($data);
        return $ticket;
    }

    public function deleteTicket($id)
    {
        $ticket = Ticket::query()->load(['approval','detail','detailact'])
        ->where('ticket_id','=',$id)->first();
        return $ticket->deleteWithRelations();
    }
}
