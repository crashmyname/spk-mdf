<?php

namespace App\DTO\DetailTicket;

final class DetailActDTO
{
    // DTO here
    public function __construct(
        public ?string $act_repair = null,
        public ?string $date_act = null,
        public ?string $act_by = null,
        public ?string $total_hours_act = null,
    ){}

    public static function ResponseDTO(object $detail)
    {
        return new self(
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
