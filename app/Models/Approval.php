<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class Approval extends BaseModel
{
    // Model logic here
    public $table = 'approval';
    protected $primaryKey = 'approval_id';
    protected array $hidden = ['approval_id','ticket_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id','ticket_id');
    }
}
