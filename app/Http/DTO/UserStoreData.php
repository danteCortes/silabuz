<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

class UserStoreData extends Data
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
        public string $confirm,
        public string $country
    ){}
}