<?php

namespace App\Repository\Manager;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class  userRepo
{
    public $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        $user = $this->query->create([
            'name' => Str::before( $data["email"],  "@" ),
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::uuid(),
        ]);
        event(new Registered($user));
        return $user->createToken(
            'token-name', ['*'], now()->addWeek()
        )->plainTextToken;
    }
}
