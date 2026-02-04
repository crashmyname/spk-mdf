<?php

namespace App\Models;
use Bpjs\Framework\Helpers\BaseModel;

class User extends BaseModel {
    
    // Protected table Users
    public $table = 'users';
    protected $primaryKey = 'user_id';
}