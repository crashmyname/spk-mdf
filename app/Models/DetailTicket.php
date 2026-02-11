<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class DetailTicket extends BaseModel
{
    // Model logic here
    public $table = 'detail_ticket';
    protected $primaryKey = 'detail_id';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id','ticket_id');
    }
}
