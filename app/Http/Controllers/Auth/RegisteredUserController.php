<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repository\Manager\userRepo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request, userRepo $userRepo): \Illuminate\Http\JsonResponse
    {
        $token = $userRepo->create($request->validated());
        return response()->json(['token' => $token], 200);
    }
}
