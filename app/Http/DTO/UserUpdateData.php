<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

class UserUpdateData extends Data
{
    public function __construct(
        public string $email,
        public string $name,
        public string $country
    ){}
}