<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class User extends BaseModel {
    
    // Protected table Users
    public $table = 'users';
    protected $primaryKey = 'user_id';

    protected array $hidden = ['user_id','password']; 

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'user_id','user_id');
    }
}