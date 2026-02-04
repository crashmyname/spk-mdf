<?php

namespace App\Services;
use App\Models\User;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Auth;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;

class AuthService
{
    // Service logic here
    public function login(array $data)
    {
        $credentials = [
            'identifier' => $data['username'],
            'password' => $data['password']
        ];
        $user = User::query()->where('username','=',$data['username'])->first();
        if(!$user){
            return [
                'status' => 404,
                'message' => 'Username not found'
            ];
        }
        if(Auth::attempt($credentials)){
            if(Request::isAjax()){       
                return ['status'=>200,'message'=>'Berhasil login'];
            }
            return ['status'=>200,'message'=>'Berhasil login'];
        } else {
            return [
                'status' => 400,
                'message' => 'Username atau password salah'
            ];
        }
    }
}
