<?php

namespace App\Http\Controllers;

use App\Repository\Manager\userRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $google = Socialite::driver('google')->user();
            $userFind = $this->userRepo->getFindEmail($google->email);
            if ($userFind) {
                $user = $this->userRepo->createGoogle($google);
                $token = $this->userRepo->generate($user);
                return response()->json(['token' => $token], 200);
            }
            $token = $this->userRepo->generate($userFind);
            return response()->json(['token' => $token], 200);
        } catch (\Exception $exception) {
            return $exception ;
        }
    }
}
