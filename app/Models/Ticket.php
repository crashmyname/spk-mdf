<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class Ticket extends BaseModel
{
    // Model logic here
    public $table = 'ticket';
    protected $primaryKey = 'ticket_id';
    // protected array $hidden = ['user_id','material_id'];

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

    public function material()
    {
        return $this->hasOne(Materials::class,'material_id','material_id');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class, 'ticket_id','ticket_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailTicket::class,'ticket_id','ticket_id');
    }

    public function detailact()
    {
        return $this->hasMany(DetailAct::class, 'ticket_id','ticket_id');
    }
}
