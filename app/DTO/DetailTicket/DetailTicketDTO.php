<?php

namespace App\DTO\DetailTicket;

use App\Models\DetailTicket;

final class DetailTicketDTO
{
    // DTO here
    public function __construct(
        public ?string $detail_item = null,
        public ?string $repair_req = null,
        public ?string $date_repair = null,
        public ?string $repair_by = null,
        public ?string $total_hours_plan = null,
        public ?string $act_repair = null,
        public ?string $date_act = null,
        public ?string $act_by = null,
        public ?string $total_hours_act = null,
    ){}

    public static function ResponseDTO(object $detail)
    {
        return new self(
            $detail->detail_item,
            $detail->repair_req,
            $detail->date_repair,
            $detail->repair_by,
            $detail->total_hours_plan,
            $detail->act_repair,
            $detail->date_act,
            $detail->act_by,
            $detail->total_hours_act,
        );
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public static function collection($details)
    {
        $result = [];

        foreach ($details as $item) {
            $result[] = self::ResponseDTO($item)->toArray();
        }

        return $result;
    }
}
