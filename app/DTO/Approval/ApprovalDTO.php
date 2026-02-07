<?php

namespace App\DTO\Approval;

final class ApprovalDTO
{
    // DTO here
    public function __construct(
        public string $ticket_id,
        public string $created_by,
        public string $date_create,
        public ?string $checked_by = null,
        public ?string $date_checked = null,
        public ?string $approved_by = null,
        public ?string $date_approved = null,
        public ?string $approved_qc_by = null,
        public ?string $date_approved_qc = null,
        public ?string $status = null,
        public ?string $date_status = null,
    ){}
}
