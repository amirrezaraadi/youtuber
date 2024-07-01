<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidTokenException;
use App\Exceptions\TokenNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\DeleteOldTokens;
use App\Repository\Manager\userRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    protected $userRepo;

    public function __construct(userRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {;
        try {
            $token = $this->userRepo->checkUser($request->validated());
            return response()->json(['token' => $token]);
        } catch (InvalidTokenException $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {

        try {
            $user = Auth::guard('api')->user();
            if (!$user || !$user->currentAccessToken()) throw new TokenNotFoundException();
            $user->currentAccessToken()->delete();
            return response()->json(['good bay :) '] ,200);
        } catch (TokenNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
