<?php

namespace App\DTO\Ticket;

use App\DTO\Material\MaterialRelationDTO;
use App\DTO\User\UserRelationDTO;

final class TicketRelationDTO
{
    // DTO here
    public function __construct(
        public string $no_order,
        public string $date_create,
        public UserRelationDTO $user,
        public string $action,
        public string $type_ticket,
        public MaterialRelationDTO $material,
        public string $lot_shot,
        public string $total_shot,
        public string $sketch_item,
        public string $options
    ){}
}
