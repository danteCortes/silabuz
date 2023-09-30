<?php

namespace App\Http\DTO;

use Spatie\LaravelData\Data;

class ChangePasswordData extends Data
{
    public function __construct(
        public string $password
    ){}
}