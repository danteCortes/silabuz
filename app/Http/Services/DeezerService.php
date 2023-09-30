<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Interfaces\IDeezerService;
use GuzzleHttp\Client;

class DeezerService implements IDeezerService
{
    private $deezerAPI;

    public function __construct(Client $deezerAPI)
    {
        $this->deezerAPI = $deezerAPI;
    }

    public function album(string $id): JsonResponse
    {
        try{
            $response = $this->deezerAPI->request('GET', '/album/' . $id);
            $data = json_decode($response->getBody(), true);
            
            return response()->json($data, 200);

        }catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    
    public function artist(string $id): JsonResponse
    {
        try{
            $response = $this->deezerAPI->request('GET', '/artist/' . $id);
            $data = json_decode($response->getBody(), true);
            
            return response()->json($data, 200);

        }catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    
    public function search(string $keyword): JsonResponse
    {
        try{
            $response = $this->deezerAPI->request('GET', '/search?q=' . $keyword);
            $data = json_decode($response->getBody(), true);
            
            return response()->json($data, 200);

        }catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

}