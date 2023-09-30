<?php

namespace App\Http\Repositories;

use Exception;
use App\Models\User;
use App\Http\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements IUserRepository
{
    public function userPaginate(Request $request): LengthAwarePaginator
    {
        try {
            if($request->search){
                $users = User::where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhere('country', 'like', '%'.$request->search.'%')
                    ->paginate(10)
                ;
            }else{
                $users = User::paginate(10);
            }

            return $users;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    
    public function getUserById(string $id): User | null
    {
        try {
            return User::find($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}