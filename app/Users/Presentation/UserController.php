<?php

namespace App\Users\Presentation;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Users\Application\UsersQuery;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UsersQuery $usersQuery;

    public function __construct(UsersQuery $usersQuery)
    {
        $this->usersQuery = $usersQuery;
    }

    public function index(): JsonResponse
    {
        $users = $this->usersQuery->execute();
        return response()->json($users);
    }

    public function show($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }
}
