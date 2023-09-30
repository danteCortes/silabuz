<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

class LoginAuthData extends Data
{
    public function __construct(
        public string $email,
        public string $password
    ){}
}