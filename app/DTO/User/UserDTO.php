<?php

namespace App\DTO\User;

use App\Models\User;

final class UserDTO
{
    // DTO here
    public function __construct(
        public string $uuid,
        public string $username,
        public string $name,
        public string $email,
        public string $section,
        public string $role
    ){}

    public static function getUserDTO(User $user)
    {
        return new self(
            $user->uuid,
            $user->username,
            $user->name,
            $user->email,
            $user->section,
            $user->role
        );
    }
}
