<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class DetailAct extends BaseModel
{
    // Model logic here
    public $table = 'detail_actual';
    protected $primaryKey = 'detail_act_id';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id','ticket_id');
    }
}
