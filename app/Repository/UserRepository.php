<?php

namespace App\Repository;

use App\Models\User;
use Bpjs\Framework\Helpers\Char;
use Bpjs\Framework\Helpers\Hash;
use Bpjs\Framework\Helpers\Response;

class UserRepository
{
    // Repository here
    public function getUserById($data)
    {
        $user = User::query()->where('username','=',$data)->first();
        return $user;
    }

    public function createUser(array $data)
    {
        $request = [
            'uuid' => Char::uuid(),
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'email' => $data['email'],
            'section' => $data['section'],
            'role' => $data['role'],
        ];
        $user = User::create($request);
        return $user;
    }

    public function updateUser(array $data)
    {
        $conditions = [
            'username' => $data['username']
        ];
        $user = User::query()->where('username','=',$conditions['username'])->first()
                    ->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::query()->where('username','=',$id)->first();
        $user->delete();
        return $user;
    }
}
