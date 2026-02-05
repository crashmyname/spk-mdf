<?php

namespace App\Repository;

use App\DTO\Ticket\TicketDTO;
use App\Models\Ticket;

class TicketRepository
{
    // Repository here
    public function getTicketById($data)
    {
        $ticket = Ticket::find($data);
        return $ticket;
    }

    public function createTicket(array $data)
    {
        $attribute = new TicketDTO(
            $data['no_order'],
            $data['date_create'],
            $data['user_id'],
            $data['action'],
            $data['type_ticket'],
            $data['material_id'],
            $data['lot_shot'],
            $data['total_shot'],
            $data['sketch_item'],
            $data['options'],
        );
        $ticket = Ticket::create($attribute);
        return $ticket;
    }

    public function updateTicket(array $data)
    {
        $conditions = [
            'ticket_id' => $data['ticket_id']
        ];
        $ticket = Ticket::find($conditions)
                    ->update($data);
        return $ticket;
    }

    public function deleteTicket($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return $ticket;
    }
}
