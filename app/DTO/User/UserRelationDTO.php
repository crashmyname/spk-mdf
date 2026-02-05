<?php

namespace App\DTO\User;

final class UserRelationDTO
{
    // DTO here
    public function __construct(
        public string $username,
        public string $name,
        public string $section,
    ){}
}
