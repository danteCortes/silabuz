<?php

namespace App\Http\Interfaces;

use Illuminate\Http\JsonResponse;

interface IDeezerService
{
    public function album(string $id): JsonResponse;
    
    public function artist(string $id): JsonResponse;
    
    public function search(string $keyword): JsonResponse;
}