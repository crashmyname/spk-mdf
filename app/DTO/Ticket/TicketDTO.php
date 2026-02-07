<?php

namespace App\DTO\Ticket;

final class TicketDTO
{
    // DTO here
    public function __construct(
        public string $no_order,
        public string $date_create,
        public string $user_id,
        public string $action,
        public string $type_ticket,
        public string $material_id,
        public string $lot_shot,
        public string $total_shot,
        public string $sketch_item,
        public string $options
    ){}

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
