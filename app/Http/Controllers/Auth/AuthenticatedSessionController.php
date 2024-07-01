<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidTokenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
    {
        try {
            $token = $this->userRepo->checkUser($request->validated());
            return response()->json(['token' => $token]);
        } catch (InvalidTokenException $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
