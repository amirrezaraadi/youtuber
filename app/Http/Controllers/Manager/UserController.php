<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\UserCreateRequest;
use App\Models\User;
use App\Repository\Manager\userRepo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index()
    {
        return $this->userRepo->index();
    }

    public function store(UserCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->userCreate($request->validated());
        return response()->json(['message' => 'success create user', 'status' => 'success'], 200);
    }


    public function show($user)
    {
        return $this->userRepo->getFinId($user);
    }


    public function update(UserCreateRequest $request, $user): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepo->getFinId($user);
        $this->userRepo->update($request->validated(), $user);
        return response()->json(["message" => 'success update user ', 'status' => 'success'], 200);
    }


    public function destroy($user): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepo->getFinId($user);
        // TODO reaships
        $this->userRepo->delete($user->id);
        return response()->json(["message" => 'success delete user ', 'status' => 'success'], 200);
    }
}
