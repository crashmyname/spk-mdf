<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class Ticket extends BaseModel
{
    // Model logic here
    public $table = 'ticket';
    protected $primaryKey = 'ticket_id';
}
