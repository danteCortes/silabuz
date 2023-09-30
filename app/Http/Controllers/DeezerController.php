<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\DeezerService;

class DeezerController extends Controller
{
    private $deezerService;

    public function __construct(DeezerService $deezerService)
    {
        $this->deezerService = $deezerService;
    }

    public function album(string $id)
    {
        try{
            return $this->deezerService->album($id);
        }catch(Exception $e){
            return response()->json($e->getMessage(), true);
        }
    }

    public function artist(string $id)
    {
        try{
            return $this->deezerService->artist($id);
        }catch(Exception $e){
            return response()->json($e->getMessage(), true);
        }
    }

    public function search(Request $request)
    {
        try{
            return $this->deezerService->search($request->q ? $request->q : '');
        }catch(Exception $e){
            return response()->json($e->getMessage(), true);
        }
    }
}
