<?php

namespace App\DTO\DetailTicket;

use App\Models\DetailTicket;
use Bpjs\Framework\Helpers\Crypto;

final class DetailTicketDTO
{
    // DTO here
    public function __construct(
        public ?string $detail_item = null,
        public ?string $repair_req = null,
        public ?string $date_repair = null,
        public ?string $repair_by = null,
        public ?string $total_hours_plan = null,
    ){}

    public static function ResponseDTO(object $detail)
    {
        return new self(
            $detail->detail_item,
            $detail->repair_req,
            $detail->date_repair,
            $detail->repair_by,
            $detail->total_hours_plan,
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
            $row = self::ResponseDTO($item)->toArray();
            $row['hash'] = Crypto::encrypt($item->detail_id);
            $result[] = $row;
        }

        return $result;
    }
}
